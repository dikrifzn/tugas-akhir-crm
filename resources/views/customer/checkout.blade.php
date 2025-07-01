@extends('layouts.app')

@section('content')
<section class="relative text-center py-24 text-white font-primary bg-cover bg-center" style="background-image: url('/image/hero.png')">
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>
  <div class="relative z-10">
    <h1 class="font-sekunder text-4xl my-5">CheckOut</h1>
    <p>Cek kembali produk pilihan Anda dan jadilah bagian dari perubahan!</p>
  </div>
</section>

<section class="xl:px-20 md:px-10 px-5 pt-10">
  <h1 class="text-xl sm:text-2xl font-semibold mb-2 text-gray-900">CheckOut</h1>
  <p class="text-gray-700 font-semibold mb-6 text-sm sm:text-base">
    {{ count($products) }} produk akan segera dibeli
  </p>

  <form method="POST" action="{{ route('checkout.store') }}">
    @csrf
    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
    <input type="hidden" name="diskon" value="{{ $diskon }}">
    <input type="hidden" name="pengiriman" value="{{ $pengiriman }}">
    <input type="hidden" name="layanan" value="{{ $layanan }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <input type="hidden" name="address" value="{{ $shipping->address ?? $user->address }}">
    <input type="hidden" name="voucher_id" value="{{ $voucherId }}">


    <!-- Produk Dipesan -->
    <div class="px-4 sm:px-10 lg:px-20 mt-5 container mx-auto p-6 border-2 border-primary bg-white shadow-xl rounded-lg">
      <h2 class="text-xl sm:text-2xl font-medium mb-6 text-gray-900">Produk Dipesan</h2>

      <div class="hidden sm:grid grid-cols-4 font-bold text-gray-900 mb-4">
        <div class="text-left">Produk</div>
        <div class="text-center">Harga</div>
        <div class="text-center">Jumlah</div>
        <div class="text-center">Total</div>
      </div>

      @foreach ($products as $item)
      <div class="border-t py-4">
        <div class="grid grid-cols-1 sm:grid-cols-4 items-start sm:items-center gap-4">
          <div class="flex items-start gap-4">
            <img src="{{ asset($item->image) }}" alt="Produk" class="w-16 h-16 rounded" />
            <div>
              <p class="text-sm">{{ $item->category }}</p>
              <p class="text-base sm:text-lg font-semibold">{{ $item->name }}</p>
              <p class="text-sm sm:text-md text-gray-700">Kondisi {{ $item->condition }}</p>
              <p class="text-sm sm:text-md text-gray-700">Ukuran {{ $item->size }}</p>
            </div>
          </div>
          <div class="font-bold text-center text-sm sm:text-base">Rp. {{ number_format($item->price) }}</div>
          <div class="font-bold text-center text-sm sm:text-base">{{ $item->quantity }}</div>
          <div class="font-bold text-center text-sm sm:text-base">Rp. {{ number_format($item->price * $item->quantity) }}</div>
        </div>
      </div>
      @endforeach

      <div class="border-t pt-4 mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h5 class="text-base sm:text-sm">Pesan Untuk Penjual</h5>
        <input type="text" name="note" placeholder="Kasih Catatan! (Opsional)" class="w-full sm:w-1/2 p-2 border rounded-lg text-sm font-medium border-primary" />
        <div class="text-base sm:text-lg">
          Total Pesanan ({{ $totalQuantity }} Produk): <span class="text-primary font-bold">Rp. {{ number_format($totalPrice) }}</span>
        </div>
      </div>
    </div>

    <!-- Alamat Pengiriman -->
    <div class="px-20 mt-5 container mx-auto p-6 bg-white shadow-xl rounded-lg border-t-8 border-primary">
      <h2 class="text-2xl font-bold mb-6">Alamat Pengiriman</h2>
      <div class="flex justify-between items-start border-b pb-4">
        <div>
          <p class="font-semibold">{{ $shipping->recipient_name }}</p>
          <p>{{ $shipping->phone }}</p>
          <p>{{ $shipping->address}} {{ $shipping->city}} {{ $shipping->province}} ({{ $shipping->postal_code}})</p>
        </div>
        <a href="/profile" class="text-blue-500">Ubah</a>
      </div>
    </div>

    <!-- Pembayaran -->
    <div class="mt-10 mb-20 container mx-auto p-6 border-2 border-primary bg-white shadow-xl rounded-lg">
      <h2 class="text-2xl font-bold mb-6">Pembayaran</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h3 class="text-xl font-semibold mb-4">Pilih Bank</h3>
          <div class="space-y-4">
            @foreach($banks as $bank)
            <label class="flex items-center space-x-4">
              <input type="radio" name="bank" value="{{ $bank }}" class="accent-primary" required />
              <span class="text-lg">{{ $bank }}</span>
            </label>
            @endforeach
          </div>
        </div>
        <div class="border-2 border-primary rounded px-5 py-5">
          <h3 class="text-xl font-semibold mb-4">Rincian Pembayaran</h3>
          <div class="space-y-3">
            <div class="flex justify-between"><span>Subtotal keranjang</span><span>Rp. {{ number_format($subtotal) }}</span></div>
            <div class="flex justify-between text-green-500"><span>
            <!-- Diskon / Promo -->
            @if ($voucherCode)
              <div class="text-green-600 mt-2">
                Voucher <strong>{{ $voucherCode }}</strong> diterapkan.
              </div>
            @endif  
            </span><span>- Rp. {{ number_format($diskon) }}</span></div>
            <div class="flex justify-between"><span>Subtotal Pengiriman</span><span>Rp. {{ number_format($pengiriman) }}</span></div>
            <div class="flex justify-between"><span>Biaya Layanan</span><span>Rp. {{ number_format($layanan) }}</span></div>
            <div class="border-t pt-4 flex justify-between font-bold">
              <span>TOTAL</span>
              <span class="text-primary">Rp. {{ number_format($subtotal - $diskon + $pengiriman + $layanan) }}</span>
            </div>
          </div>
          <div class="mt-4 flex justify-end">
            <button class="bg-[#A6752E] text-white px-6 py-3 rounded-lg hover:bg-opacity-90">Buat Pesanan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
@endsection