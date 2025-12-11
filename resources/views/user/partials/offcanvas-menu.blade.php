<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
    <div class="offcanvas-header justify-content-between">
        <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <li class="nav-item border-dashed {{ request()->routeIs('user.category', 'compost') ? 'active' : '' }}">
                <a href="{{ route ('category.show', 'compost')}}" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#fruits"></use></svg>
                    <span>Organic Fertilizer</span>
                </a>
            </li>
            <li class="nav-item border-dashed {{ request()->routeIs('user.category', 'charcoal') ? 'active' : '' }}">
                <a href="{{ route('category.show', 'charcoal') }}" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#dairy"></use></svg>
                    <span>Charcoal Briquettes</span>
                </a>
            </li>
            <li class="nav-item border-dashed {{ request()->routeIs('user.category', 'liquid-compost') ? 'active' : '' }}">
                <a href="{{ route('category.show', 'liquid-compost') }}" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#meat"></use></svg>
                    <span>Liquid Compost Fertilizer</span>
                </a>
            </li>
        </ul>
    </div>
</div>