<footer class="bg-[#A6752E] text-[#fafafa] font-[Poppins] lg:py-8 py-10">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 lg:px-14 text-center md:text-left">
      
      <!-- Logo dan Deskripsi -->
      <div class="lg:col-span-2">
        <img
          src="{{ asset('image/logo/logo3.png') }}"
          alt="Logo"
          class="w-32 mx-auto md:mx-0"
        />
        <p class="pt-4 text-sm leading-relaxed">
          Batik Berkelanjutan dengan Pewarna Alami. <br />
          Jual, Tukar, dan Lestarikan Tradisi <br />
          dengan Komunitas Ramah Lingkungan.
        </p>
      </div>

      <!-- Link -->
      <div>
        <h2 class="font-bold text-lg font-[Water_Brush]">Link</h2>
        <div class="pt-4 space-y-2 text-sm">
          <p><a href="{{ url('/') }}" class="hover:underline">Home</a></p>
          <p><a href="{{ url('/produk') }}" class="hover:underline">Produk</a></p>
        </div>
      </div>

      <!-- Fitur -->
      <div>
        <h2 class="font-bold text-lg font-[Water_Brush]">Fitur</h2>
        <div class="pt-4 space-y-2 text-sm">
          <p><a href="{{ url('/chatbot') }}" class="hover:underline">ChatBot</a></p>
          <p><a href="{{ url('/rebatik') }}" class="hover:underline">ReBatik</a></p>
          <p><a href="{{ url('/jual') }}" class="hover:underline">Jual</a></p>
        </div>
      </div>

      <!-- Contact -->
      <div class="lg:col-span-2">
        <h2 class="font-bold text-lg font-[Water_Brush]">Contact</h2>
        <div class="pt-4 space-y-3 text-sm">
          <div class="flex items-center justify-center md:justify-start gap-3">
            <i class="fa-brands fa-github text-2xl"></i>
            <a href="https://github.com/Alope-Community" class="hover:underline">
              github.com/Alope-Community
            </a>
          </div>
          <div class="flex items-center justify-center md:justify-start gap-3">
            <i class="fa-brands fa-instagram text-2xl"></i>
            <a href="https://www.instagram.com/alope.world" class="hover:underline">
              @alope.world
            </a>
          </div>
          <div class="flex items-center justify-center md:justify-start gap-3">
            <i class="fa-solid fa-phone text-2xl"></i>
            <a href="#" class="hover:underline">+62 123-1234-1234</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Garis dan Copyright -->
    <div class="mt-6">
      <hr class="border-[#fafafa] opacity-40" />
      <p class="text-center text-sm pt-7">
        &copy; {{ date('Y') }} Alope Anonymous. All Rights Reserved.
      </p>
    </div>
  </div>
</footer>