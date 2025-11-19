<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manfaatin - Admin Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/logom.png') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
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
              <a class="sidebar-link" href="{{ route('admin.ecommerce') }}" aria-expanded="false">
                <i class="fa-regular fa-file-lines"></i>
                <span class="hide-menu">Blog</span>
              </a>
            </li>


            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <i class="ti ti-calendar"></i>
                <span class="hide-menu">Calendar</span>
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

            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Authentication</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <i class="ti ti-login"></i>
                <span class="hide-menu">Login</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <i class="ti ti-user-plus"></i>
                <span class="hide-menu">Register</span>
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
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Tasks</p>
                    </a>
                    <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
          <div class="row">
            <div class="col-lg-8">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Sales Overview</h4>
                      <p class="card-subtitle">Monthly sales performance</p>
                    </div>
                    <div class="ms-auto">
                      <ul class="list-unstyled mb-0">
                        <li class="list-inline-item text-primary">
                          <span class="round-8 text-bg-primary rounded-circle me-1 d-inline-block"></span>
                          Current Month
                        </li>
                        <li class="list-inline-item text-info">
                          <span class="round-8 text-bg-info rounded-circle me-1 d-inline-block"></span>
                          Last Month
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div id="sales-overview" class="mt-4 mx-n6"></div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card overflow-hidden">
                <div class="card-body pb-0">
                  <div class="d-flex align-items-start">
                    <div>
                      <h4 class="card-title">Weekly Stats</h4>
                      <p class="card-subtitle">Performance metrics</p>
                    </div>
                  </div>

                  <div class="mt-4 pb-3 d-flex align-items-center">
                    <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-shopping-cart fs-6"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Top Sales</h5>
                      <span class="text-muted fs-3">$45,890</span>
                    </div>
                    <div class="ms-auto">
                      <span class="badge bg-success-subtle text-success">+68%</span>
                    </div>
                  </div>

                  <div class="py-3 d-flex align-items-center">
                    <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-star fs-6"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Best Product</h5>
                      <span class="text-muted fs-3">Product A</span>
                    </div>
                    <div class="ms-auto">
                      <span class="badge bg-success-subtle text-success">+42%</span>
                    </div>
                  </div>

                  <div class="py-3 d-flex align-items-center">
                    <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-message-dots fs-6"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Reviews</h5>
                      <span class="text-muted fs-3">1,245 Reviews</span>
                    </div>
                    <div class="ms-auto">
                      <span class="badge bg-success-subtle text-success">+28%</span>
                    </div>
                  </div>

                  <div class="pt-3 mb-7 d-flex align-items-center">
                    <span class="btn btn-info rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-users fs-6"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">New Users</h5>
                      <span class="text-muted fs-3">342 Users</span>
                    </div>
                    <div class="ms-auto">
                      <span class="badge bg-success-subtle text-success">+15%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Recent Transactions</h4>
                      <p class="card-subtitle">Latest orders and activities</p>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                      <select class="form-select theme-select border-0" aria-label="Period">
                        <option value="1">November 2025</option>
                        <option value="2">October 2025</option>
                        <option value="3">September 2025</option>
                      </select>
                    </div>
                  </div>

                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap align-middle">
                      <thead>
                        <tr>
                          <th scope="col" class="px-0 text-muted">Customer</th>
                          <th scope="col" class="px-0 text-muted">Product</th>
                          <th scope="col" class="px-0 text-muted">Status</th>
                          <th scope="col" class="px-0 text-muted text-end">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="px-0">
                            <div class="d-flex align-items-center">
                              <img src="{{ asset('admin/assets/images/profile/user-3.jpg') }}" class="rounded-circle"
                                width="40" alt="user" />
                              <div class="ms-3">
                                <h6 class="mb-0 fw-bolder">John Doe</h6>
                                <span class="text-muted">john@email.com</span>
                              </div>
                            </div>
                          </td>
                          <td class="px-0">Premium Package</td>
                          <td class="px-0">
                            <span class="badge bg-success">Completed</span>
                          </td>
                          <td class="px-0 text-dark fw-medium text-end">Rp 3.900.000</td>
                        </tr>
                        <tr>
                          <td class="px-0">
                            <div class="d-flex align-items-center">
                              <img src="{{ asset('admin/assets/images/profile/user-5.jpg') }}" class="rounded-circle"
                                width="40" alt="user" />
                              <div class="ms-3">
                                <h6 class="mb-0 fw-bolder">Jane Smith</h6>
                                <span class="text-muted">jane@email.com</span>
                              </div>
                            </div>
                          </td>
                          <td class="px-0">Basic Package</td>
                          <td class="px-0">
                            <span class="badge bg-warning">Pending</span>
                          </td>
                          <td class="px-0 text-dark fw-medium text-end">Rp 1.500.000</td>
                        </tr>
                        <tr>
                          <td class="px-0">
                            <div class="d-flex align-items-center">
                              <img src="{{ asset('admin/assets/images/profile/user-6.jpg') }}" class="rounded-circle"
                                width="40" alt="user" />
                              <div class="ms-3">
                                <h6 class="mb-0 fw-bolder">Mike Johnson</h6>
                                <span class="text-muted">mike@email.com</span>
                              </div>
                            </div>
                          </td>
                          <td class="px-0">Enterprise Package</td>
                          <td class="px-0">
                            <span class="badge bg-success">Completed</span>
                          </td>
                          <td class="px-0 text-dark fw-medium text-end">Rp 12.800.000</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

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
</body>

</html>