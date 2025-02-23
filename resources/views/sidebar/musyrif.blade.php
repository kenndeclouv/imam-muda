<li class="menu-item {{ request()->routeIs('musyrif.student.attendance.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-calendar-check fs-6"></i>
        <div class="text-truncate">
            Kehadiran Santri
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('musyrif.student.attendance.index', 'musyrif.student.attendance.edit', 'musyrif.student.attendance.show') ? 'active' : '' }}">
            <a href="{{ route('musyrif.student.attendance.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Kehadiran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('musyrif.student.attendance.create') ? 'active' : '' }}">
            <a href="{{ route('musyrif.student.attendance.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Kehadiran</div>
            </a>
        </li>
    </ul>
</li>
