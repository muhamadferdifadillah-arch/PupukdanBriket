<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">
          
            <!-- Logo & Menu Toggle -->
            <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="{{ route('user.home') }}">
                        <img src="{{ asset('user/images/logos.png') }}" alt="Manfaatin Logo" class="img-fluid" style="max-width: 180px;">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#menu"></use></svg>
                </button>
            </div>
          
            <!-- Search Bar -->
            <!-- Search Bar -->
<div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-flex justify-content-center">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent" id="searchCategory">
                            <option value="">All Categories</option>
                            <option value="compost">Compost</option>
                            <option value="charcoal">Charcoal</option>
                            <option value="liquid">Liquid Fertilizer</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form" class="text-center" action="{{ route('user.search') }}" method="GET">
                            <input type="text" name="q" class="form-control border-0 bg-transparent" placeholder="Search products..." value="{{ request('q') }}">
                        </form>
                    </div>
                    <div class="col-1">
                        <button type="submit" form="search-form" class="btn btn-link p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="col-lg-4">
                <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                        <a href="{{ route('user.home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                            <li><a href="{{ route('user.about') }}" class="dropdown-item">About Us</a></li>
                            <li><a href="{{ route('user.shop') }}" class="dropdown-item">Shop</a></li>
                            <li><a href="{{ route('user.cart') }}" class="dropdown-item">Cart</a></li>
                            <li><a href="{{ route('user.checkout') }}" class="dropdown-item">Checkout</a></li>
                            <li><a href="{{ route('user.blog') }}" class="dropdown-item">Blog</a></li>
                            <li><a href="{{ route('user.contact') }}" class="dropdown-item">Contact</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
          
            <!-- User Actions -->
            <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    <li>
                        @auth
                        <a href="{{ route('user.account') }}" class="p-2 mx-1" title="My Account">
                            <svg width="24" height="24"><use xlink:href="#user"></use></svg>
                        </a>
                        @else
                        <a href="{{ route('user.login') }}" class="p-2 mx-1" title="Login">
                            <svg width="24" height="24"><use xlink:href="#user"></use></svg>
                        </a>
                        @endauth
                    </li>
                    <li>
                        <a href="{{ route('user.wishlist') }}" class="p-2 mx-1 position-relative" title="Wishlist">
                            <svg width="24" height="24"><use xlink:href="#wishlist"></use></svg>
                            @if(isset($wishlistCount) && $wishlistCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $wishlistCount }}
                            </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1 position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart" title="Cart">
                            <svg width="24" height="24"><use xlink:href="#shopping-bag"></use></svg>
                            @if(isset($cartCount) && $cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                {{ $cartCount }}
                            </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>