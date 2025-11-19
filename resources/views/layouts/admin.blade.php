<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- CSS bawaan template admin -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />

</head>

<body>

    <!-- Sidebar + Header (ambil dari template admin kamu) -->
    @include('partials.admin-sidebar')
    @include('partials.admin-header')

    <div class="body-wrapper">
        @yield('content')
    </div>

    <!-- JS bawaan template -->
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <!-- APEXCHARTS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @yield('scripts')

</body>

</html>
