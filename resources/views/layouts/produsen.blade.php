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
            padding: 16px 20px;
            border-bottom: 1px solid #eaeaea;
            display: flex;
            align-items: center;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
        }

        .logo-sidebar {
            width: 140px;
            /* ✅ UKURAN SEDANG */
            height: auto;
            object-fit: contain;
        }

        .sidebar-nav ul li a.active {
            background: #3556f6;
            color: #fff !important;
        }

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
                    <a href="{{ route('produsen.dashboard') }}" class="logo-wrapper">
                        <img src="{{ asset('admin/assets/images/logos/logom.png') }}" alt="Logo Manfaatin"
                            class="logo-sidebar">
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

            {{-- PAGE CONTENT --}}
            <div class="container-fluid py-4">
                @yield('content')
            </div>

        </div>

        <style>
            /* Samakan lebar konten dengan dashboard admin */
            .container-fluid {
                max-width: 1200px;
                margin-left: 0;
                margin-right: auto;
            }
        </style>



        {{-- JS ADMIN --}}
        <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
</body>

</html>