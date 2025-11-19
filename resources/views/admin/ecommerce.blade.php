<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manfaatin - eCommerce Products</title>
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
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">eCommerce</h3>
      </div>
    </div>

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
            <img src="{{ asset('admin/assets/images/logos/logom.png') }}" alt="Logo Manfaatin" width="120" height="auto" style="object-fit: contain;" />
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
              <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
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
              <a class="sidebar-link active" href="{{ route('admin.ecommerce') }}" aria-expanded="false">
                <i class="ti ti-shopping-cart"></i>
                <span class="hide-menu">eCommerce</span>
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
                        <img src="{{ asset('admin/assets/images/profile/user-3.jpg') }}" alt="" class="rounded-circle" width="32">
                      </span>
                      <div>
                        <h6 class="mb-0">New Order #1234</h6>
                        <span class="fs-2 text-muted">5 minutes ago</span>
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
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('admin/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
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
          
          <!-- Page Header -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h2 class="mb-1">Products Management</h2>
                  <p class="text-muted mb-0">Manage your products and inventory</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                  <i class="ti ti-plus"></i> Add New Product
                </button>
              </div>
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="round-48 rounded-circle text-bg-primary d-flex align-items-center justify-content-center">
                      <i class="ti ti-shopping-cart fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 text-muted">Total Products</h6>
                      <h3 class="mb-0 mt-1">{{ count($products) }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="round-48 rounded-circle text-bg-success d-flex align-items-center justify-content-center">
                      <i class="ti ti-checks fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 text-muted">Active Products</h6>
                      <h3 class="mb-0 mt-1">
                        {{ collect($products)->where('status', 'active')->count() }}
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="round-48 rounded-circle text-bg-warning d-flex align-items-center justify-content-center">
                      <i class="ti ti-alert-triangle fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 text-muted">Out of Stock</h6>
                      <h3 class="mb-0 mt-1">
                        {{ collect($products)->where('stock', 0)->count() }}
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="round-48 rounded-circle text-bg-info d-flex align-items-center justify-content-center">
                      <i class="ti ti-currency-dollar fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 text-muted">Total Value</h6>
                      <h3 class="mb-0 mt-1">
                        Rp {{ number_format(collect($products)->sum('price'), 0, ',', '.') }}
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Products Grid -->
          <div class="row">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="position-relative">
                  <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 200px; object-fit: cover;">
                  @if($product['stock'] == 0)
                  <span class="position-absolute top-0 end-0 badge bg-danger m-2">Out of Stock</span>
                  @else
                  <span class="position-absolute top-0 end-0 badge bg-success m-2">In Stock</span>
                  @endif
                </div>
                <div class="card-body">
                  <span class="badge bg-primary-subtle text-primary mb-2">{{ $product['category'] }}</span>
                  <h5 class="card-title mb-2">{{ $product['name'] }}</h5>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <h4 class="text-primary mb-0">Rp {{ number_format($product['price'], 0, ',', '.') }}</h4>
                      <small class="text-muted">Stock: {{ $product['stock'] }} units</small>
                    </div>
                  </div>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary flex-fill" onclick="editProduct({{ $product['id'] }})">
                      <i class="ti ti-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteProduct({{ $product['id'] }})">
                      <i class="ti ti-trash"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Products Table -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-3">Product List</h4>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Status</th>
                          <th class="text-end">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $product)
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                              <div class="ms-3">
                                <h6 class="mb-0">{{ $product['name'] }}</h6>
                                <small class="text-muted">ID: #{{ $product['id'] }}</small>
                              </div>
                            </div>
                          </td>
                          <td>{{ $product['category'] }}</td>
                          <td>
                            <strong>Rp {{ number_format($product['price'], 0, ',', '.') }}</strong>
                          </td>
                          <td>
                            @if($product['stock'] > 20)
                            <span class="badge bg-success-subtle text-success">{{ $product['stock'] }} units</span>
                            @elseif($product['stock'] > 0)
                            <span class="badge bg-warning-subtle text-warning">{{ $product['stock'] }} units</span>
                            @else
                            <span class="badge bg-danger-subtle text-danger">Out of Stock</span>
                            @endif
                          </td>
                          <td>
                            @if($product['status'] == 'active')
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                          </td>
                          <td class="text-end">
                            <div class="dropdown">
                              <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="ti ti-eye me-2"></i>View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti ti-edit me-2"></i>Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        @endforeach
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

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" placeholder="Enter product name">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Category</label>
                <select class="form-select">
                  <option>Digital Service</option>
                  <option>Physical Product</option>
                  <option>Subscription</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Price (Rp)</label>
                <input type="number" class="form-control" placeholder="0">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" class="form-control" placeholder="0">
              </div>
              <div class="col-12 mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" class="form-control">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Add Product</button>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  
  <script>
    function editProduct(id) {
      alert('Edit product ID: ' + id);
      // Tambahkan logic edit di sini
    }
    
    function deleteProduct(id) {
      if(confirm('Are you sure you want to delete this product?')) {
        alert('Delete product ID: ' + id);
        // Tambahkan logic delete di sini
      }
    }
  </script>
</body>

</html>