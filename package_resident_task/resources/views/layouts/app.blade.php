<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  .bg-navbar {
    background-color: #B8CFCE !important;
  }
  body{
    background-color: #B8CFCE !important;
  }
  .bg-layout {
    background-color: #5A827E !important;
  }
  .bg-nav-dark{
    background-color: #37635e !important;
  }
  .bg-v-light{
    background-color: #84AE92 !important;
  }
</style>
</head>

<body class="bg-navbarl">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-layout shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

            </div>
        </nav>

        <main class="py-4 w-100 bg-navbar">
            <div class="container mb-3">
                <x-back-button />
            </div>
            @yield('content')
        </main>
    </div>
    @stack('scripts')

</body>
</html>