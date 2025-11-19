<aside class="left-sidebar">
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
            <img src="{{ asset('admin/assets/images/logos/logos.png') }}" width="120">
        </a>
    </div>

    <nav class="sidebar-nav">
        <ul id="sidebarnav">

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="ti ti-atom"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>
