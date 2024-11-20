<li class="menu-item {{ request()->is('imam/jadwal*') ? 'open active' : '' }}">
    <a href="{{ route('imam.jadwal.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-calendar-lines-pen fs-6"></i>
        <div class="text-truncate">
            Jadwal
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->is('imam/jadwal*') ? 'active' : '' }}">
            <a href="{{ route('imam.jadwal.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Jadwal</div>
            </a>
        </li>
    </ul>
</li>
