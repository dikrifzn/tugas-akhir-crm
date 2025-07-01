<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('image/logo/logo 4.png') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white text-gray-900 font-sans antialiased">
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


  @include('partials.navbar')

  <main class="min-h-screen">
    @yield('content')
  </main>

  @include('partials.footer')

</body>
</html>