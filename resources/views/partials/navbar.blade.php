<nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent text-white">
  <div class="container mx-auto px-5 py-4 flex justify-between items-center">
    <!-- Logo -->
    <div>
      <img id="navbar-logo" src="{{ asset('image/logo/logo1.png') }}" class="h-10 transition-all duration-300" alt="Logo" />
    </div>

    <!-- Menu Desktop -->
    <ul id="navbar-menu" class="hidden md:flex space-x-6 font-semibold">
      <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
      <li><a href="{{ url('/product') }}" class="nav-link">Produk</a></li>
    </ul>

    <!-- Icon Desktop -->
    <div class="hidden md:flex space-x-4 items-center">
      <a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart text-xl"></i></a>

      @auth
        <a href="{{ url('/profile') }}"><i class="fas fa-user text-xl"></i></a>
      @endauth

      @guest
        <a href="{{ route('login') }}">Sign In</a>
      @endguest
    </div>

    <!-- Hamburger Mobile -->
    <button id="hamburger-btn" class="md:hidden text-white focus:outline-none text-xl">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- Menu Mobile -->
  <div id="mobile-menu" class="hidden md:hidden bg-white text-[#A6752E] shadow-md w-full">
    <ul class="flex flex-col items-center space-y-4 py-4">
      <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
      <li><a href="{{ url('/product') }}" class="nav-link">Produk</a></li>
    </ul>

    <div class="flex justify-center space-x-6 pb-4">
      <a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart text-xl"></i></a>

      @auth
        <a href="{{ url('/profile') }}"><i class="fas fa-user text-xl"></i></a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"><i class="fas fa-sign-out-alt text-xl"></i></button>
        </form>
      @endauth

      @guest
        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt text-xl"></i></a>
        <a href="{{ route('register') }}"><i class="fas fa-user-plus text-xl"></i></a>
      @endguest
    </div>
  </div>
</nav>

<!-- FontAwesome CDN -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>

<style>
  .nav-link {
    position: relative;
    display: inline-block;
    padding-bottom: 4px;
  }

  .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: currentColor;
    transition: width 0.3s ease-in-out;
  }

  .nav-link:hover::after {
    width: 100%;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    const logo = document.getElementById("navbar-logo");
    const hamburger = document.getElementById("hamburger-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    window.addEventListener("scroll", function () {
      const scrolled = window.scrollY > 10;

      if (scrolled) {
        navbar.classList.remove("bg-transparent", "text-white");
        navbar.classList.add("bg-white", "text-[#A6752E]", "shadow");
        logo.src = "{{ asset('image/logo/logo2.png') }}";
      } else {
        navbar.classList.add("bg-transparent", "text-white");
        navbar.classList.remove("bg-white", "text-[#A6752E]", "shadow");
        logo.src = "{{ asset('image/logo/logo1.png') }}";
      }

      hamburger.classList.remove("text-white", "text-[#A6752E]");
      hamburger.classList.add(scrolled ? "text-[#A6752E]" : "text-white");
    });

    hamburger.addEventListener("click", function () {
      mobileMenu.classList.toggle("hidden");
    });
  });
</script>