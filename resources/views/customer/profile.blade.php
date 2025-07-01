@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<section
  class="relative text-center py-24 text-white font-primary bg-cover bg-center"
  style="background-image: url('{{ asset('image/hero.png') }}')"
>
  <div class="relative z-10">
    <h1 class="font-sekunder text-4xl my-5">Profile</h1>
    <p>
      Cek kembali produk pilihan Anda dan jadilah bagian dari perubahan!<br class="hidden md:inline" />
      Dukung keberlanjutan dengan memilih batik ramah lingkungan
    </p>
  </div>
</section>
<div x-data="{ tab: 'informasi' }">

  <div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full md:w-[300px] bg-white border-r shadow-2xl">
      <div class="p-6">
        <h2 class="text-3xl font-bold mt-5 mb-12">Profile</h2>
        <ul>
          <li class="mb-4 flex items-center" :class="{ 'border-r-4 border-primary': tab === 'informasi' }">
            <i class="fas fa-user mr-3"></i>
            <button @click="tab = 'informasi'" class="text-gray-900 text-xl hover:text-primary w-full text-left p-2">
              Informasi
            </button>
          </li>
          <li class="mb-4 flex items-center" :class="{ 'border-r-4 border-primary': tab === 'histori' }">
            <i class="fas fa-history mr-3"></i>
            <button @click="tab = 'histori'" class="text-gray-900 text-xl hover:text-primary w-full text-left p-2">
              Histori
            </button>
          </li>
          <li class="mb-6 flex items-center">
            <i class="fas fa-sign-out-alt text-xl"></i>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="text-gray-900 text-xl hover:text-primary w-full text-left p-2">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    <!-- Konten -->
    <div class="w-full p-4 md:w-3/4 md:p-10 space-y-12">
    <!-- Informasi -->
    <div x-show="tab === 'informasi'" x-data="{ previewPhoto: null }">
      <h3 class="text-xl mb-4">Informasi Profil</h3>
      <div class="border-b border-gray-900 mb-4"></div>

      <form class="flex flex-col md:flex-row space-x-6"
            method="POST"
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto Profil -->
        <div class="relative w-36 h-36">
          <!-- Preview -->
          <template x-if="previewPhoto">
            <img :src="previewPhoto"
                class="w-36 h-36 rounded-full object-cover border shadow"
                alt="Preview">
          </template>

          <!-- Existing Foto -->
          @if ($user->image_url)
            <img x-show="!previewPhoto"
                src="{{ asset('storage/' . $user->image_url) }}"
                class="w-36 h-36 rounded-full object-cover border shadow"
                alt="Foto Profil">
          @else
            <div x-show="!previewPhoto"
                class="w-36 h-36 rounded-full border flex items-center justify-center bg-gray-200">
              <i class="fas fa-user text-6xl text-gray-500"></i>
            </div>
          @endif

          <!-- Tombol Upload -->
          <label for="profile_photo"
                class="absolute bottom-2 right-2 bg-white border rounded-full flex items-center p-2 shadow cursor-pointer">
            <i class="fas fa-image text-gray-700"></i>
          </label>

          <input type="file"
                name="profile_photo"
                id="profile_photo"
                accept="image/*"
                class="hidden"
                @change="
                  const file = $event.target.files[0];
                  if (file) {
                    const reader = new FileReader();
                    reader.onload = e => previewPhoto = e.target.result;
                    reader.readAsDataURL(file);
                  }
                ">
        </div>

        <!-- Informasi -->
        <div class="flex flex-col space-y-4 w-full md:w-2/3">
          <input type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="border p-2 rounded"
                placeholder="Nama Lengkap" />

          <input type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="border p-2 rounded"
                placeholder="Email" />

          <input type="password"
                name="password"
                class="border p-2 rounded"
                placeholder="Password (kosongkan jika tidak ingin ganti)" />

          <input type="password"
                name="password_confirmation"
                class="border p-2 rounded"
                placeholder="Konfirmasi Password" />

            <!-- Alamat -->
            <h4 class="text-lg font-semibold mt-8 mb-2">Alamat Pengiriman</h4>
            <input type="text" name="recipient_name" value="{{ old('recipient_name', $user->address->recipient_name ?? '') }}"
              class="border p-2 rounded" placeholder="Nama Penerima" />
            <input type="text" name="phone" value="{{ old('phone', $user->address->phone ?? '') }}"
              class="border p-2 rounded" placeholder="No. HP" />
            <textarea name="address" class="border p-2 rounded"
              placeholder="Alamat Lengkap">{{ old('address', $user->address->address ?? '') }}</textarea>
            <input type="text" name="province" value="{{ old('province', $user->address->province ?? '') }}"
              class="border p-2 rounded" placeholder="Provinsi" />
            <input type="text" name="city" value="{{ old('city', $user->address->city ?? '') }}"
              class="border p-2 rounded" placeholder="Kota/Kabupaten" />
            <input type="text" name="postal_code" value="{{ old('postal_code', $user->address->postal_code ?? '') }}"
              class="border p-2 rounded" placeholder="Kode Pos" />

          <button type="submit"
                  class="bg-[#A6752E] text-white py-2 px-4 rounded hover:bg-primary/90 w-fit">
            Simpan
          </button>
        </div>
      </form>
    </div>
      <!-- Histori -->
      <div x-show="tab === 'histori'">
        <h3 class="text-xl mb-4">Histori</h3>
        <div class="border-b border-gray-900 mb-4"></div>

        @if ($orders->isEmpty())
          <div class="p-6 bg-gray-100 text-center rounded-lg shadow">
            <p class="text-gray-600">Belum ada histori pesanan.</p>
          </div>
        @else
          <div class="space-y-6">
            @foreach ($orders as $order)
              <div x-data="{ showDetail: false }" class="border p-4 md:p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                  <h4 class="font-semibold text-primary">Pesanan #{{ $order->id }}</h4>
                  <button @click="showDetail = !showDetail"
                    class="bg-[#A6752E] text-white py-2 px-4 rounded-md hover:bg-primary/90">
                    Detail
                  </button>
                </div>

                <table class="w-full text-sm md:text-base">
                  <thead>
                    <tr>
                      <th class="text-left p-2">Produk</th>
                      <th class="text-center p-2">Jumlah</th>
                      <th class="text-center p-2">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->items as $item)
                      <tr class="border-t">
                        <td class="py-4 flex items-center gap-4">
                          <img src="{{ asset('storage/' . $item->variant->product->image_url) }}" class="w-16 h-16 rounded-lg shadow" />
                          <div>
                            <p class="text-sm text-gray-500">{{ strtoupper($item->variant->category ?? '-') }}</p>
                            <p class="font-semibold">{{ $item->variant->product->name ?? '-' }}</p>
                          </div>
                        </td>
                        <td class="text-center font-bold p-2">{{ $item->quantity }}</td>
                        <td class="text-center text-primary font-bold text-lg p-2">
                          Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Detail Tracking -->
                <div x-show="showDetail" class="mt-6">
                  <h5 class="text-lg mb-4">Perjalanan Produk</h5>
                  @if ($order->tracking->isEmpty())
                    <p class="text-sm text-gray-500 italic">Belum ada tracking untuk pesanan ini.</p>
                  @else
                    <div class="border-l-4 border-primary p-4 rounded-lg shadow-md bg-gray-50">
                      <ul class="relative pl-6 text-md space-y-4">
                        @foreach ($order->tracking as $track)
                          <li class="flex items-start">
                            <i class="fas fa-circle text-primary mr-4 mt-1"></i>
                            <div>
                              <p class="font-semibold">{{ $track->status }}</p>
                              @if ($track->location)
                                <p class="text-sm text-gray-500">Lokasi: {{ $track->location }}</p>
                              @endif
                              <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($track->logged_at)->format('d M Y H:i') }}</p>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
