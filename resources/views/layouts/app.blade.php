<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ManfaatinOnline.com')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('user/images/logom.png') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    @stack('styles')
</head>
<body>

    <!-- Include SVG Icons -->
    @include('layouts.svg-icons')
    
    <!-- Include Header & Navigation -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Include Footer -->
    @include('layouts.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('user/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/js/plugins.js') }}"></script>
    <script src="{{ asset('user/js/script.js') }}"></script>
    
    @stack('scripts')
</body>
</html>