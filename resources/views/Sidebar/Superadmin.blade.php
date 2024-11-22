<li class="menu-item {{ request()->routeIs('superadmin.admin.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa fa-user-shield fs-6"></i>
        <div class="text-truncate">
            Admin
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('superadmin.admin.*') ? 'active' : '' }}">
            <a href="{{ route('superadmin.admin.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Admin</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Tools</span>
</li>

<li class="menu-item {{ request()->routeIs('superadmin.logs*') ? 'active' : '' }}">
    <a href="{{ route('superadmin.logs') }}" class="menu-link">
        <i class="menu-icon fa fa-file-alt fs-6"></i>
        <div class="text-truncate">Logs</div>
    </a>
</li>
