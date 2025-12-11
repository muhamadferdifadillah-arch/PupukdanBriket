<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">
            <!-- Logo & Toggle -->
            <div
                class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('user/images/logom.png') }}" alt="logo" style="width: 90px; height: auto;">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#menu"></use>
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
                <form action="{{ route('search.products') }}" method="GET"
                    class="search-bar row bg-light p-2 rounded-4">

                    <div class="col-md-4 d-none d-md-block">
                        <select name="category" class="form-select border-0 bg-transparent">
                            <option value="">All Categories</option>
                            <option value="fertilizer">Fertilizer</option>
                            <option value="charcoal">Charcoal</option>
                            <option value="compost">Compost</option>
                        </select>
                    </div>

                    <div class="col-10 col-md-7">
                        <input type="text" name="q" class="form-control border-0 bg-transparent"
                            placeholder="Search products..." required>
                    </div>

                    <div class="col-2 col-md-1 text-end">
                        <button type="submit" class="btn btn-link p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <!-- Main Navigation -->
        <div class="col-lg-4">
            <ul
                class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown"
                        aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                        <li><a href="{{ route('about') }}" class="dropdown-item">About Us</a></li>
                        <li><a href="{{ route('shop') }}" class="dropdown-item">Shop</a></li>
                        <li><a href="{{ route('cart') }}" class="dropdown-item">Cart</a></li>
                        <li><a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a></li>
                        <li><a href="{{ route('blog') }}" class="dropdown-item">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="dropdown-item">Contact</a></li>
                        <li><a href="{{ route('account') }}" class="dropdown-item">My Account</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Icons (User, Wishlist, Cart) -->
        <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
            <ul class="d-flex justify-content-end list-unstyled m-0">
                <li>
                    <a href="{{ route('account') }}" class="p-2 mx-1" title="My Account">
                        <svg width="24" height="24">
                            <use xlink:href="#user"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="{{ route('wishlist') }}" class="p-2 mx-1" title="Wishlist">
                        <svg width="24" height="24">
                            <use xlink:href="#wishlist"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                        aria-controls="offcanvasCart" title="Shopping Cart">
                        <svg width="24" height="24">
                            <use xlink:href="#shopping-bag"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</header>