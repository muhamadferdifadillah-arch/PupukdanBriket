@extends('layouts.app')

@section('title', 'Manfaatin Portal')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* GENERAL */
    body {
        background: #ffffff;
        font-family: 'Inter', sans-serif;
    }

    /* NAVBAR */
    .navbar-custom {
        background: #3b1c64; /* ungu seperti foto */
        padding: 15px 0;
    }

    .navbar-brand {
        color: white !important;
        font-weight: 700;
        font-size: 22px;
    }

    .nav-link {
        color: white !important;
        margin-left: 20px;
        font-weight: 500;
    }

    .btn-login {
        background: #00c46b;
        color: white;
        font-weight: 600;
        padding: 6px 15px;
        border-radius: 6px;
    }

    /* HERO SECTION */
    .hero-section {
        margin-top: 0;
    }

    .carousel-item img {
        width: 100%;
        height: 430px;
        object-fit: cover;
        filter: brightness(75%);
    }

    .hero-caption {
        position: absolute;
        bottom: 50px;
        left: 60px;
        color: white;
    }

    .hero-caption h1 {
        font-size: 45px;
        font-weight: 700;
    }

    .btn-market {
        background: #00c46b;
        padding: 12px 25px;
        border-radius: 8px;
        color: white;
        font-size: 18px;
        margin-top: 15px;
        transition: .3s;
    }

    .btn-market:hover {
        background: #009c55;
    }

    /* ABOUT SECTION */
    .section-title {
        font-size: 32px;
        font-weight: 700;
        color: #3b1c64;
        text-align: center;
        margin-bottom: 20px;
    }

    .about-card {
        background: #fff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        text-align: center;
        margin-bottom: 20px;
    }

    .about-card i {
        font-size: 40px;
        color: #3b1c64;
        margin-bottom: 10px;
    }

    /* POPULAR PRODUCTS */
    .product-card {
        background: #fff;
        border-radius: 14px;
        padding: 15px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        transition: .3s;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.12);
    }

    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* FOOTER */
    .footer {
        background: #3b1c64;
        color: white;
        padding: 50px 0;
        margin-top: 50px;
    }

    .footer a {
        color: #cfd1ff;
        display: block;
        margin-bottom: 5px;
        text-decoration: none;
    }

    .footer-social i {
        font-size: 24px;
        margin-right: 15px;
    }
</style>
@endpush


@section('content')

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">Manfaatin.id</a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <i class="bi bi-list text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link">ID <i class="bi bi-chevron-down"></i></a></li>
                <li class="nav-item"><a class="btn btn-login" href="/login">LOGIN</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO CAROUSEL -->
<div id="heroCarousel" class="carousel slide hero-section" data-bs-ride="carousel">
    <div class="carousel-inner">
        
        <div class="carousel-item active">
            <img src="https://picsum.photos/1200/430?random=1" alt="">
            <div class="hero-caption">
                <h1>Belanja Lebih Mudah,<br> Cepat, dan Aman</h1>
                <a href="/shop" class="btn-market">Masuk ke Marketplace</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://picsum.photos/1200/430?random=2" alt="">
        </div>

        <div class="carousel-item">
            <img src="https://picsum.photos/1200/430?random=3" alt="">
        </div>

    </div>
</div>


<!-- ABOUT SECTION -->
<div class="container mt-5">
    <h2 class="section-title">Tentang Manfaatin.id</h2>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="about-card">
                <i class="bi bi-clock-history"></i>
                <h5>Pelayanan Cepat</h5>
                <p class="text-muted small">Proses transaksi yang cepat dan mudah digunakan.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="about-card">
                <i class="bi bi-geo-alt"></i>
                <h5>Layanan Luas</h5>
                <p class="text-muted small">Menjangkau seluruh wilayah Indonesia.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="about-card">
                <i class="bi bi-info-circle"></i>
                <h5>Informasi Lengkap</h5>
                <p class="text-muted small">Detail produk dan supplier yang terpercaya.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="about-card">
                <i class="bi bi-credit-card"></i>
                <h5>Pembayaran Mudah</h5>
                <p class="text-muted small">Mendukung e-wallet & transfer bank.</p>
            </div>
        </div>

    </div>
</div>


<!-- POPULAR PRODUCTS -->
<div class="container mt-5">
    <h2 class="section-title">Produk Populer</h2>

    <div class="row mt-4">

        {{-- Dummy produk - nanti bisa di-loop dari database --}}
        @for ($i = 1; $i <= 4; $i++)
        <div class="col-md-3 mb-3">
            <div class="product-card">
                <img src="https://picsum.photos/200/150?random={{ $i }}" alt="">
                <h5 class="mt-2">Produk {{ $i }}</h5>
                <p class="text-muted small mb-1">Kategori {{ $i }}</p>
                <strong>Rp {{ number_format(15000 * $i, 0, ',', '.') }}</strong>
            </div>
        </div>
        @endfor

    </div>
</div>


<!-- FOOTER -->
<footer class="footer mt-5">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <h4 class="fw-bold">Manfaatin.id</h4>
                <p class="text-light mt-2">Platform marketplace yang menyediakan berbagai produk kebutuhan Anda dengan aman dan cepat.</p>

                <div class="footer-social mt-3">
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-twitter"></i>
                </div>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">Kontak</h5>
                <a>Telepon: 0812-3456-7890</a>
                <a>Email: support@manfaatin.id</a>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">Informasi</h5>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
            </div>

        </div>
    </div>
</footer>

@endsection
