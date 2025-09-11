@php
    $permissions = Auth::user()->getPermissionCodes();
@endphp

{{-- @if ($permissions->contains('jadwal_show')) --}}
    <li class="menu-item {{ request()->routeIs('takmir.jadwal.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-calendar-lines-pen fs-6"></i>
            <div class="text-truncate">
                Jadwal Imam
            </div>
        </a>
        <ul class="menu-sub">

            <li
                class="menu-item {{ request()->routeIs('takmir.jadwal.fixed.index', 'takmir.jadwal.fixed.edit') ? 'active' : '' }}">
                <a href="{{ route('takmir.jadwal.fixed.index') }}" class="menu-link">
                    <div class="text-truncate">Jadwal Tetap</div>
                </a>
            </li>
        </ul>
    </li>
{{-- @endif --}}
