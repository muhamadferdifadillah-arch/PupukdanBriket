<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Manfaatin Online')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('user/images/logom.png') }}">
    <link rel="shortcut icon" href="{{ asset('user/images/logom.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('user/images/logom.png') }}">
    
    <!-- Include Head (CSS, Fonts, etc) -->
    @include('user.layouts.head')
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    @stack('styles')
</head>
<body>
    @include('user.partials.svg-icons')
    
    <div class="preloader-wrapper">
        <div class="preloader"></div>
    </div>

    @include('user.partials.offcanvas-cart')
    @include('user.partials.offcanvas-menu')
    @include('user.partials.header')

    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')
    @include('user.layouts.scripts')
    @stack('scripts')
    
    <script>
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader-wrapper');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => preloader.style.display = 'none', 300);
            }
        });
    </script>
</body>
</html>