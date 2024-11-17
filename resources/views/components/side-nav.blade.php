<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand my-4">
        <a href="" class="app-brand-link">
            <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') . ' logo' }}"
                style="max-width:100%; border-radius:5px">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="fa-solid fa-chevron-left d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('*.home') ? 'active' : '' }}">
            <a href="{{ route(str_replace('_', '', Auth::user()->Role->code) . '.home') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-house fs-6"></i>
                <div class="text-truncate">
                    Beranda
                </div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu</span>
        </li>
        @switch(Auth::user()->Role->code)
            @case('admin')
                @include('Sidebar.Admin')
            @break

            @case('super_admin')
                @include('Sidebar.SuperAdmin')
            @break

            @case('imam')
                @include('Sidebar.Imam')
            @break

            @default
        @endswitch

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Profile</span>
        </li>
        <li class="menu-item {{ request()->routeIs('account') ? 'active' : '' }}">
            <a href="{{ route('account') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-address-card fs-6"></i>
                <div class="text-truncate" data-i18n="Profile">Profile</div>
            </a>
        </li>
    </ul>
</aside>
