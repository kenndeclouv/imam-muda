<li class="menu-item {{ request()->routeIs('admin.imam.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user fs-6"></i>
        <div class="text-truncate">
            Imam
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.imam.index', 'admin.imam.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.imam.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Imam</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.imam.create') ? 'active' : '' }}">
            <a href="{{ route('admin.imam.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Imam</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.shalat.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-person-praying fs-6"></i>
        <div class="text-truncate">
            Shalat
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.shalat.index', 'admin.shalat.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.shalat.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Shalat</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.shalat.create') ? 'active' : '' }}">
            <a href="{{ route('admin.shalat.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Shalat</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.masjid.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-mosque fs-6"></i>
        <div class="text-truncate">
            Masjid
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.masjid.index', 'admin.masjid.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.masjid.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Masjid</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.masjid.create') ? 'active' : '' }}">
            <a href="{{ route('admin.masjid.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Masjid</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.jadwal.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-calendar-lines-pen fs-6"></i>
        <div class="text-truncate">
            Jadwal
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.jadwal.index', 'admin.jadwal.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.jadwal.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Jadwal</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.jadwal.create') ? 'active' : '' }}">
            <a href="{{ route('admin.jadwal.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Jadwal</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.bayaran.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-money-bill fs-6"></i>
        <div class="text-truncate">
            Bayaran
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.bayaran.index', 'admin.bayaran.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.bayaran.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Bayaran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.bayaran.create') ? 'active' : '' }}">
            <a href="{{ route('admin.bayaran.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Bayaran</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.rekap.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-file fs-6"></i>
        <div class="text-truncate">
            Rekap
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.rekap.imam.index') ? 'active' : '' }}">
            <a href="{{ route('admin.rekap.imam.index') }}" class="menu-link">
                <div class="text-truncate">Rekap Imam</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.statistik.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-chart-bar fs-6"></i>
        <div class="text-truncate">
            Statistik
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.statistik.index') ? 'active' : '' }}">
            <a href="{{ route('admin.statistik.index') }}" class="menu-link">
                <div class="text-truncate">Lihat Statistik</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Tools</span>
</li>
<li class="menu-item {{ request()->routeIs('admin.pengumuman.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-bullhorn fs-6"></i>
        <div class="text-truncate">
            Pengumuman
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.pengumuman.index') ? 'active' : '' }}">
            <a href="{{ route('admin.pengumuman.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Pengumuman</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.pengumuman.create') ? 'active' : '' }}">
            <a href="{{ route('admin.pengumuman.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Pengumuman</div>
            </a>
        </li>
    </ul>
</li>
