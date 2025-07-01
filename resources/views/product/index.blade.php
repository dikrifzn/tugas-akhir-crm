@extends('layouts.app')

@section('content')
<section
  class="relative text-center py-24 text-sekunder font-primary bg-cover bg-center"
  style="background-image: url('{{ asset('image/hero.png') }}')"
>
  <div class="relative text-white z-10">
    <h1 class="font-sekunder text-4xl my-5">List Produk</h1>
    <p>
      Temukan beragam batik berkualitas, dari batik baru, second,
      <br class="hidden md:inline" />
      hingga koleksi ReBatik—mengusung tradisi, keberlanjutan,
      <br class="hidden md:inline" />
      dan gaya ramah lingkungan.
    </p>
  </div>
</section>

<section class="container mx-auto my-10 px-6 lg:px-14">
  <form method="GET" action="{{ route('product.index') }}" class="mb-6">
    <div class="flex items-center max-w-md mx-auto">
      <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari Batik..."
        class="w-full border border-primary rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none"
      />
      <button
        type="submit"
        class="bg-primary text-white px-4 py-2 rounded-r-lg hover:bg-primary/90"
      >
        Cari
      </button>
    </div>
  </form>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($products as $product)
      <a href="{{ route('product.show', $product->id) }}">
        <div class="bg-white border border-primary rounded-lg shadow overflow-hidden">
          <img
            src="{{ asset('storage/' . $product->image_url) }}"
            alt="{{ $product->name }}"
            class="w-full aspect-[4/3] object-cover"
          />
          <div class="p-4">
            <div class="flex justify-between items-center min-h-[56px]">
              <h3 class="text-lg font-semibold min-h-[48px]">{{ $product->name }}</h3>
            </div>
            <p class="text-gray-800 font-bold min-h-[24px]">
              Rp. {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <div class="flex items-center mt-2">
              <span class="text-yellow-500">★</span>
              <span class="ml-1 text-gray-600">4.4</span>
            </div>
            <div class="flex justify-between items-center mt-2">
              <span class="bg-primary/30 text-primary text-xs font-semibold px-3 py-1 rounded-full">
                {{ $product->condition }}
              </span>
              <img src="{{ asset('/image/logo/logo2.png') }}" alt="Logo" class="w-20 h-8" />
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>

  {{-- Pagination --}}
  <div class="mt-10">
    {{ $products->withQueryString()->links() }}
  </div>
</section>
@endsection