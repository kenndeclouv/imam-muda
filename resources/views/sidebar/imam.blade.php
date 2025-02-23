<li class="menu-item {{ request()->routeIs('imam.jadwal.*') ? 'open active' : '' }}">
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
<li class="menu-item {{ request()->routeIs('imam.student.memorization.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-book-open fs-6"></i>
        <div class="text-truncate">
            Hafalan Santri
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('imam.student.memorization.index', 'imam.student.memorization.edit', 'imam.student.memorization.show') ? 'active' : '' }}">
            <a href="{{ route('imam.student.memorization.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Hafalan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('imam.student.memorization.create') ? 'active' : '' }}">
            <a href="{{ route('imam.student.memorization.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Hafalan</div>
            </a>
        </li>
    </ul>
</li>
