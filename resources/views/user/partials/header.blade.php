<header>
  <div class="container-fluid">
    <div class="row py-3 align-items-center">

      <div class="col-lg-2 col-md-3 text-center text-md-start">
        <a href="{{ route('home') }}">
          <img src="{{ asset('user/images/logom.png') }}" alt="Manfaatin Logo" style="width: 90px; height: auto;">
        </a>
      </div>

      <!-- 🔥 SEARCH BAR FIXED (HANYA 1 FORM, VALID HTML) -->
      <div class="col-lg-5 col-md-6 my-3 my-md-0">

        <form action="{{ route('search.products') }}" method="GET" class="search-bar row bg-light p-2 rounded-4">

          <div class="col-md-4 d-none d-md-block">
            <select name="category" class="form-select border-0 bg-transparent">
              <option value="">All Categories</option>
              <option value="fertilizer">Fertilizer</option>
              <option value="charcoal">Charcoal</option>
              <option value="compost">Compost</option>
            </select>
          </div>

          <div class="col-10 col-md-7">
            <input type="text"
                   name="q"
                   class="form-control border-0 bg-transparent"
                   placeholder="Search products..."
                   required>
          </div>

          <div class="col-2 col-md-1 text-end">
            <button type="submit" class="btn btn-link p-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                   viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
              </svg>
            </button>
          </div>

        </form>

      </div>
      <!-- END SEARCH BAR -->

      <div class="col-lg-2 col-md-3">
        <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 justify-content-center fw-bold text-uppercase mb-0">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Shop</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 d-flex gap-3 justify-content-center justify-content-lg-end">
        <a href="#" class="btn btn-link p-2">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="7" r="4"></circle>
            <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
          </svg>
        </a>
        <a href="/cart" class="btn btn-link p-2 position-relative">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          @php
            $cart = Session::get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
          @endphp
          @if($cartCount > 0)
          @endif
        </a>
      </div>

    </div>
  </div>
</header>
