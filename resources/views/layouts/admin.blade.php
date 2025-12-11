<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Aplikasi Manfaatin')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/logom.png') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
  @stack('css')
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- App Topstrip -->
    <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="{{ route('admin.dashboard') }}">
          <span class="text-white fw-bold">MANFAATIN ADMIN</span>
        </a>
      </div>

      <div class="d-lg-flex align-items-center gap-2">
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">Dashboard</h3>
      </div>
    </div>

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
            <img src="{{ asset('admin/assets/images/logos/logom.png') }}" alt="Logo Manfaatin" width="120" height="auto"
              style="object-fit: contain;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link active" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li>

            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Apps</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.ecommerce') }}" aria-expanded="false">
                <i class="ti ti-shopping-cart"></i>
                <span class="hide-menu">eCommerce</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.login') }}" aria-expanded="false">
                <i class="ti ti-login"></i>
                <span class="hide-menu">Login</span>
              </a>
              <a class="sidebar-link" href="{{ route('admin.register') }}" aria-expanded="false">
                <i class="ti ti-user-plus"></i>
                <span class="hide-menu">Register</span>
              </a>

            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <i class="ti ti-message-dots"></i>
                <span class="hide-menu">Chat</span>
              </a>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main wrapper -->
    <div class="body-wrapper">
      <!-- Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-bell"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="message-body">
                  <a href="javascript:void(0)" class="dropdown-item">
                    <div class="d-flex align-items-center gap-3 py-2">
                      <span class="flex-shrink-0">
                        <img src="{{ asset('admin/assets/images/profile/user-3.jpg') }}" alt="" class="rounded-circle"
                          width="32">
                      </span>
                      <div>
                        <h6 class="mb-0">New notification</h6>
                        <span class="fs-2 text-muted">Just now</span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('admin/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35"
                    class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">

                        <a href="{{ route('admin.profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                          <i class="ti ti-user fs-6"></i>
                          <p class="mb-0 fs-3">My Profile</p>
                        </a>

                        <form action="{{ route('admin.logout') }}" method="POST" class="mx-3 mt-2">
                          @csrf
                          <button type="submit" class="btn btn-outline-primary d-block w-100">
                            <i class="ti ti-logout"></i> Logout
                          </button>
                        </form>

                      </div>
                    </div>

              </li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!-- Dashboard Content -->
          @yield('content')
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">© 2025 Manfaatin. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  @stack('js')
</body>

</html>