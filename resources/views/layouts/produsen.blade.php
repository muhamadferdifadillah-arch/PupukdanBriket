<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Produsen</title>
    <link rel="icon" type="image/png" href="{{ asset('user/images/logom.png') }}">


    {{-- CSS ADMIN (BIAR SAMA) --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        .app-logo {
            padding: 20px;
            border-bottom: 1px solid #eaeaea;
        }

        .app-logo img {
            height: 36px;
        }

        .sidebar-nav ul li a.active {
            background: #3556f6;
            color: #fff !important;
        }
    </style>
    <style>
        .body-wrapper {
            padding-top: 0 !important;
        }
    </style>


</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical">

        {{-- SIDEBAR --}}
        <aside class="left-sidebar">
            <div>

                {{-- LOGO --}}
                <div class="app-logo d-flex align-items-center">
                    <a href="{{ route('produsen.dashboard') }}">
                        {{-- GANTI LOGO DI SINI --}}
                        <img src="{{ asset('user/images/logom.png') }}" alt="Logo" style="height:36px;">

                    </a>
                </div>

                {{-- MENU --}}
                <nav class="sidebar-nav scroll-sidebar">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <span class="hide-menu">HOME</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('produsen/dashboard*') ? 'active' : '' }}"
                                href="{{ route('produsen.dashboard') }}">
                                <i class="ti ti-layout-dashboard"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('produsen.produk') ? 'active' : '' }}"
                                href="{{ route('produsen.produk') }}">
                                <i class="ti ti-package"></i>
                                <span class="hide-menu">Produk</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('produsen.reports') ? 'active' : '' }}"
                                href="{{ route('produsen.reports') }}">
                                <i class="ti ti-chart-bar"></i>
                                <span class="hide-menu">Rekapan Pesanan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->routeIs('produsen.promo.*') ? 'active' : '' }}"
                                href="{{ route('produsen.promo.index') }}">
                                <i class="ti ti-tag"></i>
                                <span class="hide-menu">Promo</span>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-logout"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('produsen.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </li>


                    </ul>
                </nav>

            </div>
        </aside>

        {{-- CONTENT --}}
        <div class="body-wrapper">

            {{-- HEADER / TOPBAR --}}
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i class="ti ti-bell"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <img src="https://ui-avatars.com/api/?name=Produsen" class="rounded-circle" width="35"
                                    alt="user">
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            {{-- PAGE CONTENT --}}
            <div class="container-fluid py-4">
                @yield('content')
            </div>

        </div>


        {{-- JS ADMIN --}}
        <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
</body>

</html>