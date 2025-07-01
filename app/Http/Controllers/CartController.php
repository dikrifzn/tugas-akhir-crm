<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Voucher;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::with('items.variant.product')->where('user_id', $user->id)->first();

        if (!$cart) {
            $cartItems = collect();
        } else {
            $cartItems = $cart->items->map(function ($item) {
                $variant = $item->variant;
                $product = $variant->product;

                return (object) [
                    'id' => $item->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image_url ?? '/image/default.png',
                    'quantity' => $item->quantity,
                    'gender' => $product->gender ?? '-',
                    'size' => $variant->size ?? '-',
                    'condition' => $variant->condition ?? 'baru',
                ];
            });
        }

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $diskon = 0;

        if (session('voucher_code')) {
            $type = session('voucher_type');
            $value = session('voucher_value');

            if ($type === 'percentage') {
                $diskon = $subtotal * ($value / 100);
            } elseif ($type === 'fixed') {
                $diskon = $value;
            }
        }
        $pengiriman = 10000;
        $layanan = 2500;
        return view('customer.cart', compact('cartItems', 'subtotal', 'diskon', 'pengiriman', 'layanan'));
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_variant_id' => $request->product_variant_id,
        ]);

        $item->quantity = ($item->exists ? $item->quantity : 0) + $request->quantity;
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function updateItem(Request $request, $itemId)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->firstOrFail();

        $item = CartItem::where('id', $itemId)->where('cart_id', $cart->id)->firstOrFail();

        if ($request->has('increase')) {
            $item->quantity++;
        } elseif ($request->has('decrease')) {
            $item->quantity = max(1, $item->quantity - 1);
        }

        $item->save();

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    public function removeItem($itemId)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        CartItem::where('id', $itemId)
            ->where('cart_id', optional($cart)->id)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        $voucher = Voucher::where('code', $request->voucher_code)->first();

        if (!$voucher || ($voucher->expired_at && Carbon::now()->gt($voucher->expired_at))) {
            return back()->with('voucher_error', 'Voucher tidak valid atau telah kedaluwarsa.');
        }

        $user = Auth::user();
        $cart = Cart::with('items.variant.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('voucher_error', 'Keranjang Anda kosong.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->variant->product->price * $item->quantity;
        });

        if ($voucher->min_purchase && $subtotal < $voucher->min_purchase) {
            return back()->with('voucher_error', 'Minimal pembelian untuk voucher ini adalah Rp. ' . number_format($voucher->min_purchase));
        }

        // Simpan di session
        session([
            'voucher_id' => $voucher->id,
            'voucher_code' => $voucher->code,
            'voucher_type' => $voucher->type,
            'voucher_value' => $voucher->value,
        ]);

        return back()->with('success', 'Voucher berhasil diterapkan!');
    }
    public function removeVoucher()
    {
        session()->forget(['voucher_code', 'voucher_type', 'voucher_value']);
        return back()->with('success', 'Voucher dibatalkan.');
    }

}