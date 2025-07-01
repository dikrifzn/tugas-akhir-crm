@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')

<section class="relative text-center py-24 text-sekunder font-primary bg-cover bg-center" style="background-image: url('{{ asset('image/hero.png') }}')">
  <div class="relative text-white z-10">
    <h1 class="font-sekunder text-4xl my-5">Detail Produk</h1>
    <p>
      Cek kembali produk pilihan Anda dan jadilah bagian<br class="hidden md:inline" />
      dari perubahan! Dukung keberlanjutan dengan<br class="hidden md:inline" />
      memilih batik ramah lingkungan
    </p>
  </div>
</section>

<section class="xl:px-20 md:px-10 px-5 pt-10">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Gambar Produk -->
    <div class="px-4">
      <div class="lg:h-[400px] lg:w-[400px] mb-4">
        <img class="w-full h-full rounded-[15px] border border-primary object-cover" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" />
      </div>
    </div>

    <!-- Detail Produk -->
    <div class="px-4 rounded-lg border-2 border-[#A6752E]">
      <div class="px-5 py-5">
        <h2 class="text-2xl font-bold text-gray-900 mb-5">{{ $product->name }}</h2>
        <div class="text-2xl mb-8 text-gray-900 font-medium">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>

        <div class="mb-4">
          <span class="font-bold text-gray-700 pr-4">Kondisi:</span>
          <span class="inline-block px-3 py-1 bg-[#A6752E]/30 text-[#A6752E] text-sm font-semibold rounded-full">{{ $product->condition }}</span>
        </div>

        <form method="POST" action="{{ route('cart.add') }}">
          @csrf
          <!-- Ukuran -->
          <div class="mb-4">
            <span class="font-bold text-gray-700">Ukuran:</span>
            <div class="flex flex-wrap gap-2 mt-2 mb-4">
              @forelse($product->variants as $variant)
                <button type="button" class="variant-btn bg-white text-gray-700 py-2 px-4 rounded-md font-bold border border-[#A6752E] hover:bg-[#A6752E] hover:text-white" data-id="{{ $variant->id }}">
                  {{ $variant->size }}
                </button>
              @empty
                <span class="text-sm text-gray-500 italic">Tidak ada ukuran tersedia</span>
              @endforelse
            </div>
            <input type="hidden" name="product_variant_id" id="product_variant_id">
          </div>

          <!-- Jumlah -->
          <div class="mb-8">
            <span class="font-bold text-gray-700 block mb-2">Jumlah:</span>
            <div class="flex items-center border border-gray-300 rounded-md w-max">
              <button type="button" class="px-4 py-2 text-gray-700 hover:bg-[#A6752E] hover:text-white" onclick="kurangiJumlah()">-</button>
              <input type="text" id="jumlah" value="1" class="w-12 text-center text-gray-700 font-semibold" readonly />
              <button type="button" class="px-4 py-2 text-gray-700 hover:bg-[#A6752E] hover:text-white" onclick="tambahJumlah()">+</button>
            </div>
            <input type="hidden" name="quantity" id="input_jumlah" value="1">
          </div>

          <!-- Tombol Aksi -->
          <div class="flex flex-col md:flex-row items-center gap-3 w-full mb-4">
            <button type="submit" class="w-full md:w-auto bg-[#A6752E]/90 text-white py-2 px-4 rounded-md font-semibold hover:bg-[#A6752E]/80">
              Masukkan Keranjang
            </button>
            <a href="{{ route('cart.index') }}" class="w-full md:w-auto text-center bg-white border-2 text-[#A6752E] border-[#A6752E] hover:text-white py-2 px-4 rounded-md font-semibold hover:bg-[#A6752E]">
              Checkout Sekarang
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Deskripsi -->
  <div class="mt-8 mb-10 max-w-7xl mx-auto">
    <div class="border-2 border-[#A6752E] rounded-lg px-5 py-5">
      <h3 class="text-xl font-bold mb-4 text-gray-900">Deskripsi Produk</h3>
      <p class="text-justify text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
    </div>
  </div>

  <!-- Produk Lainnya -->
  <div class="mb-20 max-w-7xl mx-auto">
    <h3 class="text-xl font-bold mb-6 text-gray-900">Produk Lainnya</h3>
    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
      @foreach ($relatedProducts as $item)
        <a href="{{ route('product.show', $item->id) }}" class="block bg-white border border-primary rounded-lg shadow-lg overflow-hidden mb-10">
          <img class="w-full h-64 object-cover" src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" />
          <div class="p-4">
            <div class="flex justify-between items-center">
              <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
              <p class="text-gray-600 text-sm">{{ optional($item->variants->first())->size ?? '-' }}</p>
            </div>
            <p class="text-gray-800 font-bold">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-500">★</span>
              <span class="text-gray-600 ml-1">9.5</span>
            </div>
            <div class="flex items-center justify-between mt-2">
              <span class="inline-block px-3 py-1 bg-primary/30 text-primary text-xs font-semibold rounded-full">{{ $item->condition }}</span>
              <img src="{{ asset('/image/logo/logo2.png') }}" alt="Logo" class="w-20 h-8" />
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- Script -->
<script>
  function tambahJumlah() {
    let jumlah = document.getElementById('jumlah');
    jumlah.value = parseInt(jumlah.value) + 1;
    document.getElementById('input_jumlah').value = jumlah.value;
  }

  function kurangiJumlah() {
    let jumlah = document.getElementById('jumlah');
    if (parseInt(jumlah.value) > 1) {
      jumlah.value = parseInt(jumlah.value) - 1;
      document.getElementById('input_jumlah').value = jumlah.value;
    }
  }

  document.querySelectorAll('.variant-btn').forEach(button => {
    button.addEventListener('click', function () {
      const allButtons = document.querySelectorAll('.variant-btn');
      allButtons.forEach(btn => btn.classList.remove('bg-white', 'text-gray-700'));
      allButtons.forEach(btn => btn.classList.add('bg-[#A6752E]', 'text-white'));

      this.classList.add('bg-[#A6752E]', 'text-white');
      document.getElementById('product_variant_id').value = this.dataset.id;
    });
  });
</script>

@endsection