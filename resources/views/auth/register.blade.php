@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
  @if (session('success'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded shadow-lg z-100"
    >
        {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
      <div 
          x-data="{ show: true }"
          x-init="setTimeout(() => show = false, 3000)"
          x-show="show"
          x-transition
          class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded shadow-lg z-100"
      >
          {{ session('error') }}
      </div>
  @endif
  <div class="bg-[#A6752E] h-screen flex justify-center items-center px-4">
    <div
      class="h-auto md:h-5/6 w-full max-w-4xl flex flex-col md:flex-row rounded-xl overflow-hidden shadow-xl"
    >
      <div
        class="w-full md:w-1/2 flex justify-center items-center flex-col text-center text-white relative py-10"
        style="background-image: url({{ asset('/image/half-batik-bg.png') }}); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 bg-black/50"></div>
        <div
          class="w-5/6 flex justify-center items-center flex-col text-center relative z-10"
        >
          <img
            src="{{ asset('/image/logo/logo 4.png') }}"
            alt="Sundara Batik Logo"
            class="w-14 sm:w-12 h-auto mb-4"
          />
          <h1 class="text-xl sm:text-2xl md:text-3xl font-bold">
            Selamat Datang Di
          </h1>
          <h1 class="text-xl sm:text-2xl md:text-3xl font-bold mb-4">
            Sundara Batik
          </h1>
          <p class="text-sm sm:text-base">
            Temukan beragam batik baru dan second berkualitas di Sundara Batik,
            pilihan elegan yang ramah lingkungan dan berkelanjutan.
          </p>
        </div>
      </div>
      <div
        class="w-full md:w-1/2 bg-white flex justify-center items-center flex-col px-6 py-10"
      >
      <form method="POST" action="{{ route('register') }}">
      @csrf
        <div class="w-80 max-w-sm">
          <h1 class="text-2xl sm:text-3xl font-bold">REGISTER</h1>
          <p class="text-sm sm:text-base text-gray-500 mb-3">
            Tolong isi data anda
          </p>
          <label class="block text-gray-700">Nama Lengkap</label>
          <input
            type="text" name="name"
            class="w-full border-b-2 border-black focus:outline-none focus:border-gray-700 py-2 mb-4"
            placeholder="Masukkan Nama Lengkap"
          />
          <label class="block text-gray-700">Email</label>
          <input
            type="email" name="email"
            class="w-full border-b-2 border-black focus:outline-none focus:border-gray-700 py-2 mb-4"
            placeholder="Masukkan email"
          />
          <label class="block text-gray-700">Password</label>
          <input
            type="password" name="password"
            class="w-full border-b-2 border-black focus:outline-none focus:border-gray-700 py-2 mb-4"
            placeholder="Masukkan password"
          />
          <label class="block text-gray-700">Konfirmasi Password</label>
          <input
            type="password" name="password_confirmation"
            class="w-full border-b-2 border-black focus:outline-none focus:border-gray-700 py-2 mb-4"
            placeholder="Masukkan password"
          />
          <button
            class="w-full bg-[#996F33] text-white py-3 rounded-md text-sm sm:text-base font-semibold shadow-md hover:opacity-90 mt-3"
          >
            Daftar
          </button>
          <p class="text-center text-gray-600 mt-4 text-sm sm:text-base">
            Sudah Punya Akun? <a href="{{ route('login') }}" class="text-blue-600">Login</a>
          </p>
        </div>
      </form>
      </div>
    </div>
  </div>