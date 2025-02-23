<li class="menu-item {{ request()->routeIs('student.student.memorization.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-book-open fs-6"></i>
        <div class="text-truncate">
            Hafalan kamu
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('student.student.memorization.index', 'student.student.memorization.edit', 'student.student.memorization.show') ? 'active' : '' }}">
            <a href="{{ route('student.student.memorization.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Hafalan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('student.student.memorization.create') ? 'active' : '' }}">
            <a href="{{ route('student.student.memorization.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Hafalan</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('student.student.attendance.*') ? 'open active' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-calendar-check fs-6"></i>
        <div class="text-truncate">
            Kehadiran kamu
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('student.student.attendance.index', 'student.student.attendance.edit', 'student.student.attendance.show') ? 'active' : '' }}">
            <a href="{{ route('student.student.attendance.index') }}" class="menu-link">
                <div class="text-truncate">Daftar Kehadiran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('student.student.attendance.create') ? 'active' : '' }}">
            <a href="{{ route('student.student.attendance.create') }}" class="menu-link">
                <div class="text-truncate">Tambah Kehadiran</div>
            </a>
        </li>
    </ul>
</li>
