<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddresses;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cart = Cart::with('items.variant.product')->where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->items : collect();

        $products = $cartItems->map(function ($item) {
            $product = $item->variant->product;
            return (object) [
                'id' => $item->id,
                'category' => $product->gender ?? '-',
                'name' => $product->name,
                'condition' => $item->variant->condition ?? 'Baru',
                'size' => $item->variant->size,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'image' => 'storage/' . ($product->image_url ?? 'image/default.png'),
            ];
        });

        $subtotal = $products->sum(fn($item) => $item->price * $item->quantity);

        // 💡 Ambil data voucher dari session
        $diskon = 0;
        $voucherCode = session('voucher_code');
        $voucherType = session('voucher_type');
        $voucherValue = session('voucher_value');

        if ($voucherCode && $voucherType && $voucherValue) {
            if ($voucherType === 'percentage') {
                $diskon = $subtotal * ($voucherValue / 100);
            } elseif ($voucherType === 'fixed') {
                $diskon = $voucherValue;
            }
        }

        $pengiriman = 21500;
        $layanan = 2000;
        $total = $subtotal - $diskon + $pengiriman + $layanan;
        $totalQuantity = $products->sum('quantity');
        $totalPrice = $subtotal;
        $voucherId = session('voucher_id');

        $vouchers = Voucher::where(function ($q) {
            $q->whereNull('expired_at')->orWhere('expired_at', '>=', now());
        })->get();

        $banks = ['BCA', 'BNI', 'Mandiri', 'BRI', 'Permata', 'Lainnya'];
        $shipping = ShippingAddresses::where('user_id', $user->id)->latest()->first();

        return view('customer.checkout', compact(
            'user',
            'products',
            'subtotal',
            'diskon',
            'pengiriman',
            'layanan',
            'total',
            'vouchers',
            'voucherId',
            'banks',
            'shipping',
            'voucherCode',
            'voucherType',
            'voucherValue',
            'totalQuantity',
            'totalPrice'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = Auth::user();
        $cart = Cart::with('items.variant.product')->where('user_id', $user->id)->firstOrFail();

        $subtotal = $request->subtotal;
        $pengiriman = $request->pengiriman;
        $layanan = $request->layanan;
        $diskon = 0;

        if ($request->filled('voucher_code')) {
            $voucher = Voucher::where('code', $request->voucher_code)
                ->where(function ($q) {
                    $q->whereNull('expired_at')->orWhere('expired_at', '>=', now());
                })->first();

            if ($voucher) {
                $diskon = ($voucher->discount_percentage / 100) * $subtotal;
            }
        }

        $total = $subtotal - $diskon + $pengiriman + $layanan;
        $shipping = ShippingAddresses::where('user_id', $user->id)->latest()->first();
        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address_id' => $shipping->id,
            'voucher_id' => $request->voucher_id,
            'subtotal' => $request->subtotal,
            'discount' => $request->diskon ?? 0,
            'shipping_cost' => $request->pengiriman,
            'service_fee' => $request->layanan,
            'total' => $request->total,
            'payment_method' => $request->bank,
            'status' => 'pending',
        ]);


        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $item->variant->product->price,
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}