<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.layouts.head')
    @stack('styles')
</head>
<body>
    <!-- SVG Icons -->
    @include('user.partials.svg-icons')

    <!-- Preloader -->
    <div class="preloader-wrapper">
        <div class="preloader"></div>
    </div>

    <!-- Offcanvas Cart -->
    @include('user.partials.offcanvas-cart')
    
    <!-- Offcanvas Menu -->
    @include('user.partials.offcanvas-menu')

    <!-- Header -->
    @include('user.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Scripts -->
    @include('user.layouts.scripts')
    @stack('scripts')
</body>
</html>