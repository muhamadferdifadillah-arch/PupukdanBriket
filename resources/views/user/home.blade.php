<!DOCTYPE html>
<html lang="en">

<head>
  <title>ManfaatinOnline.com</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" href="user/images/logom.png">
  <link rel="shortcut icon" href="user/images/logom.ico">
  <link rel="apple-touch-icon" href="user/images/logom.png">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">

  <style>
    :root {
      --primary-color: #00a651;
      --secondary-color: #f8b500;
      --dark-color: #333;
      --light-color: #f5f5f5;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      color: var(--dark-color);
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Nunito', sans-serif;
    }

    /* Header Improvements */
    header {
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background: white;
    }

    .search-bar {
      border: 1px solid #ddd;
      border-radius: 20px;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    .search-bar select {
      font-size: 14px;
      border: none;
      outline: none;
      background: transparent;
      padding: 10px 15px;
      border-right: 1px solid #e0e0e0;
      cursor: pointer;
    }

    .search-bar select:focus {
      outline: none;
      box-shadow: none;
    }

    .search-bar input {
      font-size: 14px;
      border: none;
      outline: none;
      background: transparent;
      padding: 10px 15px;
      flex: 1;
    }

    .search-bar input:focus {
      outline: none;
      box-shadow: none;
    }

    .search-bar button {
      border: none;
      background: transparent;
      padding: 8px 15px;
      cursor: pointer;
      color: var(--primary-color);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-bar button:hover {
      color: var(--dark-color);
    }

    /* Hero Section */
    .hero-section {
      background-image: url('user/images/ferdi.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      min-height: 500px;
      padding: 80px 0;
    }

    .hero-content h2 {
      font-size: 3.5rem;
      line-height: 1.2;
      margin-bottom: 1.5rem;
    }

    .text-primary-green {
      color: var(--primary-color);
    }

    /* Feature Cards */
    .feature-card {
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    /* Category Section */
    .category-item {
      text-align: center;
      transition: transform 0.3s ease;
    }

    .category-item:hover {
      transform: scale(1.05);
    }

    .category-item img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin: 0 auto;
      border: 3px solid #f0f0f0;
      transition: border-color 0.3s ease;
    }

    .category-item:hover img {
      border-color: var(--primary-color);
    }

    /* Product Grid */
    .product-item {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      overflow: hidden;
      transition: box-shadow 0.3s ease;
      margin-bottom: 30px;
      background: white;
    }

    .product-item:hover {
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .product-item figure {
      margin: 0;
      padding: 0;
      background: #fff;
      height: 250px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .product-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .product-item .button-area {
      padding: 15px;
    }


    /* Banner Blocks */
    .banner-blocks {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .banner-ad {
      min-height: 250px;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
    }

    .banner-ad .banner-content {
      position: relative;
      z-index: 2;
    }

    /* Blog Cards */
    .post-item {
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .post-item:hover {
      transform: translateY(-5px);
    }

    .post-item img {
      height: 220px;
      object-fit: cover;
    }

    /* App Download Section */
    .app-download-section {
      background: var(--secondary-color);
      border-radius: 20px;
      overflow: hidden;
    }

    /* Footer */
    footer {
      background: var(--dark-color);
      color: white;
    }

    footer a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    footer a:hover {
      color: white;
    }

    #footer-bottom {
      background: #222;
      color: rgba(255, 255, 255, 0.7);
      padding: 20px 0;
    }

    /* Profile Dropdown */
    .profile-dropdown {
      position: absolute;
      top: 48px;
      right: 0;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      min-width: 180px;
      padding: 10px 0;
      display: none;
      z-index: 999;
    }

    .profile-dropdown a,
    .profile-dropdown button {
      display: block;
      width: 100%;
      padding: 10px 18px;
      font-size: 14px;
      color: #333;
      text-align: left;
      background: none;
      border: none;
      outline: none;
      text-decoration: none;
    }

    .profile-dropdown a:hover,
    .profile-dropdown button:hover {
      background: #f0f0f0;
    }

    .dropdown-logout-btn {
      cursor: pointer;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-content h2 {
        font-size: 2rem;
      }

      .banner-blocks {
        grid-template-columns: 1fr;
      }

      .search-bar {
        border-radius: 15px;
      }

      .search-bar select {
        font-size: 13px;
        padding: 8px 12px;
      }

      .search-bar input {
        font-size: 13px;
        padding: 8px 12px;
      }

      .search-bar button {
        padding: 8px 12px;
      }
    }
  </style>
</head>

<body>

  <!-- Header -->
  <header>
    <div class="container-fluid">
      <div class="row py-3 align-items-center">

        <div class="col-lg-2 col-md-3 text-center text-md-start">
          <a href="{{ url('/') }}">
            <img src="user/images/logom.png" alt="Manfaatin Logo" style="width: 90px; height: auto;">
          </a>
        </div>

        <div class="col-lg-5 col-md-6 my-3 my-md-0">
          <div class="search-bar bg-light">
            <select class="d-none d-md-block">
              <option>All Categories</option>
              <option>Fertilizer</option>
              <option>Charcoal</option>
              <option>Compost</option>
            </select>
            <input type="text" placeholder="Search products...">
            <button type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
              </svg>
            </button>
          </div>
        </div>

        <div class="col-lg-5 col-md-3">
          <div class="d-flex justify-content-center justify-content-lg-end align-items-center gap-3">

            <!-- MENU -->
            <ul class="navbar-nav list-unstyled d-none d-lg-flex flex-row gap-3 fw-semibold text-uppercase mb-0">
              <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('shop.index') }}" class="nav-link">Shop</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/about') }}" class="nav-link">Tentang Kami</a>
              </li>
            </ul>

            <!-- SPACER untuk memberikan jarak -->
            <div class="d-none d-lg-block" style="width: 40px;"></div>

            <!-- ICON PROFIL -->
            <div class="position-relative">
              <button id="profileBtn" class="btn btn-link p-2 border-0 bg-transparent">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="7" r="4"></circle>
                  <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
                </svg>
              </button>

              <div id="profileDropdown" class="profile-dropdown">
                @if(Auth::check())
                  <a href="{{ url('/profile') }}">My Profile</a>
                  <a href="{{ url('/orders') }}">My Orders</a>
                  <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-logout-btn">Logout</button>
                  </form>
                @else
                  <a href="{{ url('/login') }}">Login</a>
                  <a href="{{ url('/register') }}">Register</a>
                @endif
              </div>
            </div>

            <!-- ICON CART -->
            <a href="{{ url('/cart') }}" class="btn btn-link p-2 position-relative">
              <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
            </a>

          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ✅ TAMBAHKAN ALERT SUCCESS DI SINI (Setelah </header>) -->
  @if(session('success'))
    <div class="container-lg mt-4">
      <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
          <svg width="24" height="24" fill="currentColor" class="me-3" viewBox="0 0 24 24">
            <path
              d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
          </svg>
          <div class="flex-grow-1">
            <strong>✅ Berhasil!</strong> {{ session('success') }}
            @if(session('order_number'))
              <a href="{{ route('user.orders.show', session('order_number')) }}" class="btn btn-sm btn-success ms-2">
                <svg width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 24 24">
                  <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                </svg>
                Lihat Detail Pesanan
              </a>
            @endif
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container-lg">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <h2>
            <span class="fw-bold text-primary-green">Pemanfaatan</span> limbah sebagai<br>
            <span class="fw-bold text-primary-green">Peluang bisnis</span> bernilai tambah
          </h2>
          <p class="fs-5 mb-4">Solusi berkelanjutan untuk masa depan yang lebih hijau</p>
        </div>
      </div>

      <!-- Feature Cards -->
      <div class="row g-3 mt-5">
        <div class="col-md-4">
          <div class="card feature-card border-0 bg-primary text-white p-4">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 2C10.7 2 9.5 2.5 8.6 3.4L4 8V14C4 16.2 5.8 18 8 18V20C8 21.1 8.9 22 10 22H14C15.1 22 16 21.1 16 20V18C18.2 18 20 16.2 20 14V8L15.4 3.4C14.5 2.5 13.3 2 12 2M12 4C12.8 4 13.5 4.3 14.1 4.9L18 8.8V14C18 15.1 17.1 16 16 16H14V20H10V16H8C6.9 16 6 15.1 6 14V8.8L9.9 4.9C10.5 4.3 11.2 4 12 4M10 7V14H14V7L12 9L10 7Z" />
                </svg>
              </div>
              <div class="col-9">
                <h5 class="text-white mb-1">Fresh from the farm</h5>
                <p class="mb-0 small">Quality guaranteed products</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card border-0 bg-success text-white p-4">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.66,19.7C7.14,19.87 7.64,20 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25C4,7.25 2,11.5 2,13.5C2,15.5 3.75,17.25 3.75,17.25C7,8 17,8 17,8Z" />
                </svg>
              </div>
              <div class="col-9">
                <h5 class="text-white mb-1">100% Organic</h5>
                <p class="mb-0 small">Certified organic products</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card border-0 bg-danger text-white p-4">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                </svg>
              </div>
              <div class="col-9">
                <h5 class="text-white mb-1">Free Delivery</h5>
                <p class="mb-0 small">Free shipping to all areas</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories -->
  <section class="py-5">
    <div class="container-lg">
      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2 class="section-title">Our Categories</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">
          View All
        </a>
      </div>

      <div class="row g-4">
        <div class="col-md-4 col-6">
          <div class="category-item">
            <a href="{{ route('category.show', 'organic-fertilizer') }}" class="text-decoration-none">
              <img src="user/images/logoD.png" class="rounded-circle" alt="Fertilizer">
              <h4 class="fs-6 mt-3 fw-semibold text-dark">Organic Fertilizer</h4>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-6">
          <div class="category-item">
            <a href="{{ route('category.show', 'charcoal') }}" class="text-decoration-none">
              <img src="user/images/logoA.png" class="rounded-circle" alt="Charcoal">
              <h4 class="fs-6 mt-3 fw-semibold text-dark">Charcoal</h4>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-6">
          <div class="category-item">
            <a href="{{ route('category.show', 'charcoal-briquettes') }}" class="text-decoration-none">
              <img src="user/images/logos.png" class="rounded-circle" alt="Charcoal Briquettes">
              <h4 class="fs-6 mt-3 fw-semibold text-dark">Charcoal Briquettes</h4>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Best Selling Products -->
  <section class="py-5 bg-light">
    <div class="container-lg">
      <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Best Selling Products</h2>
        <a href="{{ url('/user/shop') }}" class="btn btn-primary">View All</a>
      </div>

      <div class="row g-4">
        @forelse($bestProducts as $product)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-item text-center p-3 shadow-sm rounded-3 bg-white">

              <!-- Produk Image - TANPA LINK -->
              <figure style="cursor: default;">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded"
                  style="height:180px; object-fit:cover; pointer-events: none;">
              </figure>

              <!-- Produk Nama -->
              <h5 class="mt-3">{{ $product->name }}</h5>

              <!-- Harga -->
              <p class="fw-bold text-dark">
                Rp {{ number_format($product->price, 0, ',', '.') }}
              </p>

              <script>
                const isLoggedIn = @json(Auth::check());
              </script>


              <!-- Tombol Add to Cart -->
              <button class="btn btn-primary w-100 btn-add-to-cart" data-product-id="{{ $product->id }}">
                Add to Cart
              </button>

            </div>
          </div>
        @empty
          <p class="text-center">Tidak ada produk</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- SCRIPT AJAX ADD TO CART -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.btn-add-to-cart');

      buttons.forEach(button => {
        button.addEventListener('click', function () {

          // ⛔ CEK LOGIN DI SINI
          if (!isLoggedIn) {
            window.location.href = "{{ route('login') }}";
            return;
          }


          // ✅ BARU LANJUT ADD TO CART JIKA LOGIN
          let productId = this.dataset.productId;
          let oldText = this.textContent;

          this.disabled = true;
          this.textContent = "Adding...";

          fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
              "X-Requested-With": "XMLHttpRequest",
              "Accept": "application/json"
            },
            body: JSON.stringify({
              product_id: productId,
              quantity: 1
            })
          })
            .then(res => res.json())
            .then(data => {
              this.disabled = false;
              this.textContent = oldText;

              if (data.success) {
                showNotification('success', data.message);
                updateCartCount(data.cart_count);
              } else {
                showNotification('error', data.message);
              }
            })
            .catch(() => {
              this.disabled = false;
              this.textContent = oldText;
              showNotification('error', 'Terjadi kesalahan');
            });
        });
      });

      // Function untuk menampilkan notifikasi
      function showNotification(type, message) {
        // Hapus notifikasi lama
        const oldNotif = document.querySelector('.toast-notification');
        if (oldNotif) oldNotif.remove();

        // Buat notifikasi baru
        const notif = document.createElement('div');
        notif.className = 'toast-notification';
        notif.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease;
        min-width: 300px;
      `;

        if (type === 'success') {
          notif.style.background = '#28a745';
          notif.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
            </svg>
            <span>${message}</span>
          </div>
        `;
        } else {
          notif.style.background = '#dc3545';
          notif.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            <span>${message}</span>
          </div>
        `;
        }

        document.body.appendChild(notif);

        // Hapus otomatis setelah 3 detik
        setTimeout(() => notif.remove(), 3000);
      }

      // Function untuk update cart count
      function updateCartCount(count) {
        const cartElements = document.querySelectorAll('.cart-count, .cart-badge');
        cartElements.forEach(el => {
          el.textContent = count;
          el.style.display = count > 0 ? 'block' : 'none';
        });
      }

      // Add CSS animation
      const style = document.createElement('style');
      style.textContent = `
      @keyframes slideIn {
        from {
          transform: translateX(400px);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
    `;
      document.head.appendChild(style);
    });
  </script>


  <!-- App Download -->
  <section class="py-5">
    <div class="container-lg">
      <div class="app-download-section pt-5">
        <div class="row align-items-center">
          <div class="col-md-6 p-5">
            <h2 class="mb-3">Download Manfaatin App</h2>
            <p class="mb-4">Online orders made easy, fast and reliable</p>
            <div class="d-flex gap-3 flex-wrap">
              <a href="#"><img src="user/images/img-app-store.png" alt="App Store" style="height: 50px;"></a>
              <a href="#"><img src="user/images/img-google-play.png" alt="Google Play" style="height: 50px;"></a>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <img src="user/images/desain21.png" alt="Mobile App" class="img-fluid" style="max-height: 400px;">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5">
    <div class="container-lg">
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <img src="user/images/logom.png" width="150" alt="Logo" class="mb-3">
          <p class="text-white-50">Sustainable solutions for a greener future</p>
          <div class="d-flex gap-2 mt-3">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="text-white mb-3">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Tentang Kami</a></li>
            <li class="mb-2"><a href="#">Produk & Kategori</a></li>
            <li class="mb-2"><a href="#">Shop</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="text-white mb-3">Customer Service</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">FAQ</a></li>
            <li class="mb-2"><a href="#">Informasi Pengiriman</a></li>
            <li class="mb-2"><a href="#">Kebijakan Pengembalian</a></li>
            <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="text-white mb-3">Newsletter</h5>
          <p class="text-white-50">Subscribe to get updates</p>
          <form class="d-flex">
            <input type="email" class="form-control" placeholder="Your email">
            <button class="btn btn-primary ms-2">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <div id="footer-bottom">
    <div class="container-lg">
      <div class="text-center">
        <p class="mb-0">© 2024 ManfaatinOnline. All rights reserved.</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Profile dropdown
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', () => {
      dropdown.style.display = 'none';
    });

    // Search functionality
    const searchInput = document.querySelector('.search-bar input[type="text"]');
    const searchButton = document.querySelector('.search-bar button');
    const searchSelect = document.querySelector('.search-bar select');

    // Function to perform search
    function performSearch() {
      const query = searchInput.value.trim();
      if (query) {
        window.location.href = `{{ url('/search') }}?q=${encodeURIComponent(query)}`;
      }
    }

    // Search button click
    searchButton.addEventListener('click', (e) => {
      e.preventDefault();
      performSearch();
    });

    // Enter key press on search input
    searchInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        performSearch();
      }
    });
  </script>

</body>

</html>