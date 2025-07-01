@extends('layouts.app')

@section('content')
<section
  class="relative text-center py-24 text-white font-primary bg-cover bg-center"
  style="background-image: url('{{ asset('image/hero.png') }}')"
>
  <div class="relative z-10">
    <h1 class="font-sekunder text-4xl my-5">Keranjang</h1>
    <p>
      Cek kembali produk pilihan Anda dan jadilah bagian dari perubahan!<br class="hidden md:inline" />
      Dukung keberlanjutan dengan memilih batik ramah lingkungan
    </p>
  </div>
</section>

<div class="container mx-auto xl:px-20 md:px-10 px-5 pt-10 pb-10">
  <h1 class="text-xl sm:text-2xl font-semibold mb-2 text-gray-900">Keranjang Belanja</h1>
  <p class="text-gray-700 font-semibold mb-6 text-sm sm:text-base">
    {{ count($cartItems) }} batik di keranjangmu
  </p>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Daftar Produk -->
    <div class="lg:col-span-2">
      <div class="border-2 border-primary rounded-lg shadow p-4 sm:p-6">
        <table class="w-full text-center text-sm sm:text-base">
          <thead>
            <tr class="border-b">
              <th class="text-left pl-1 py-2">Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cartItems as $item)
            <tr class="border-b">
              <td class="py-4 text-left">
                <div class="flex items-center gap-4">
                  <img src="{{ asset('storage/' . $item->image) }}" class="w-16 h-16 rounded" alt="{{ $item->name }}" />
                  <div>
                    <p class="text-sm font-medium">{{ $item->gender }}</p>
                    <p class="text-lg font-bold">{{ $item->name }}</p>
                    <p class="text-sm text-gray-600">Kondisi {{ $item->condition }}</p>
                    <p class="text-sm text-gray-600">Ukuran {{ $item->size }}</p>
                  </div>
                </div>
              </td>
              <td class="py-4 font-bold">Rp. {{ number_format($item->price) }}</td>
              <td class="py-4">
                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex justify-center items-center gap-2">
                  @csrf
                  @method('PUT')
                  <button name="decrease" value="{{ $item->id }}" class="px-2 py-1 border">-</button>
                  <span>{{ $item->quantity }}</span>
                  <button name="increase" value="{{ $item->id }}" class="px-2 py-1 border">+</button>
                </form>
              </td>
              <td class="py-4 font-bold">Rp. {{ number_format($item->price * $item->quantity) }}</td>
              <td class="py-4">
                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit"><i class="fa-solid fa-trash text-red-500"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Ringkasan dan Voucher -->
    <div class="lg:col-span-1">
      <div class="border-primary border-2 rounded-lg shadow p-4 sm:p-6">
        <h2 class="font-bold mb-4 text-lg text-gray-900">Ringkasan</h2>
        <div class="space-y-4 text-sm">
          <div class="flex justify-between">
            <span>Subtotal</span>
            <span>Rp. {{ number_format($subtotal) }}</span>
          </div>
          <div class="flex justify-between text-red-600">
            <span>Diskon</span>
            <span>- Rp. {{ number_format($diskon) }}</span>
          </div>
          <div class="flex justify-between">
            <span>Pengiriman</span>
            <span>Rp. {{ number_format($pengiriman) }}</span>
          </div>
          <div class="flex justify-between">
            <span>Biaya Layanan</span>
            <span>Rp. {{ number_format($layanan) }}</span>
          </div>
          <div class="border-t pt-4 font-bold flex justify-between">
            <span>Total</span>
            <span>Rp. {{ number_format($subtotal - $diskon + $pengiriman + $layanan) }}</span>
          </div>
        </div>

        <!-- Voucher -->
        @if(session('voucher_code'))
          <form action="{{ route('cart.removeVoucher') }}" method="POST" class="mt-4">
            @csrf
            <div class="flex items-center justify-between text-green-700 text-sm">
              <p>
                Voucher <strong>{{ session('voucher_code') }}</strong> diterapkan.
              </p>
              <button type="submit" class="text-red-500 underline">Batalkan</button>
            </div>
            @if(session('voucher_type'))
              <p class="text-xs text-gray-500 mt-1">
                @if(session('voucher_type') === 'percentage')
                  (Diskon {{ session('voucher_value') }}%)
                @else
                  (Diskon Rp. {{ number_format(session('voucher_value')) }})
                @endif
              </p>
            @endif
          </form>
        @else
          <form action="{{ route('cart.applyVoucher') }}" method="POST" class="mt-4">
            @csrf
            <label for="voucher_code" class="block mb-1 text-sm font-medium text-gray-700">Kode Voucher</label>
            <div class="flex gap-2">
              <input type="text" name="voucher_code" placeholder="Masukkan kode"
                class="w-full border px-3 py-2 rounded text-sm" required />
              <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 rounded">
                Terapkan
              </button>
            </div>
            @if(session('voucher_error'))
              <p class="text-sm text-red-600 mt-2">{{ session('voucher_error') }}</p>
            @endif
          </form>
        @endif

        <!-- Checkout -->
        <a
          href="{{ route('checkout') }}"
          class="block text-center mt-6 py-3 px-4 bg-[#A6752E] text-white rounded-lg hover:bg-primary/90 transition"
        >
          Check Out
        </a>
      </div>
    </div>
  </div>
</div>
@endsection