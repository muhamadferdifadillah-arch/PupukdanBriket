<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ✅ CSRF Token untuk AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Manfaatin Online')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ✅ SweetAlert2 untuk notifikasi cantik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @stack('styles')
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Manfaatin Online</a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.shop') }}">SHOP</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart"></i>
                                <span class="badge bg-success cart-count">
                                    {{ DB::table('cart')->where('user_id', Auth::id())->sum('quantity') ?? 0 }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}">
                                <i class="bi bi-person"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2024 ManfaatinOnline. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>