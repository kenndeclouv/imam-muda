@php
    $permissions = Auth::user()->getPermissionCodes();
@endphp

@if ($permissions->contains('imam_show'))
    <li class="menu-item {{ request()->routeIs('admin.imam.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user fs-6"></i>
            <div class="text-truncate">
                Imam
            </div>
        </a>
        <ul class="menu-sub">
            <li
                class="menu-item {{ request()->routeIs('admin.imam.index', 'admin.imam.edit', 'admin.imam.detail') ? 'active' : '' }}">
                <a href="{{ route('admin.imam.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Imam</div>
                </a>
            </li>
            @if ($permissions->contains('imam_create'))
                <li class="menu-item {{ request()->routeIs('admin.imam.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.imam.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Imam</div>
                    </a>
                </li>
            @endif
            @if ($permissions->contains('imam_edit'))
                <li class="menu-item {{ request()->routeIs('admin.imam.is_active') ? 'active' : '' }}">
                    <a href="{{ route('admin.imam.is_active') }}" class="menu-link">
                        <div class="text-truncate">List Imam Tidak Aktif</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($permissions->contains('student_show'))
    <li class="menu-item {{ request()->routeIs('admin.student.*') && !request()->routeIs('admin.student.memorization.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-user-graduate fs-6"></i>
            <div class="text-truncate">
                Santri
            </div>
        </a>
        <ul class="menu-sub">
            <li
                class="menu-item {{ request()->routeIs('admin.student.index', 'admin.student.edit', 'admin.student.detail') ? 'active' : '' }}">
                <a href="{{ route('admin.student.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Santri</div>
                </a>
            </li>
            @if ($permissions->contains('student_create'))
                <li class="menu-item {{ request()->routeIs('admin.student.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Santri</div>
                    </a>
                </li>
            @endif
            @if ($permissions->contains('student_edit'))
                <li class="menu-item {{ request()->routeIs('admin.student.is_active') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.is_active') }}" class="menu-link">
                        <div class="text-truncate">List Santri Tidak Aktif</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($permissions->contains('shalat_show'))
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
            @if ($permissions->contains('shalat_create'))
                <li class="menu-item {{ request()->routeIs('admin.shalat.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.shalat.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Shalat</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($permissions->contains('masjid_show'))
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
            @if ($permissions->contains('masjid_create'))
                <li class="menu-item {{ request()->routeIs('admin.masjid.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.masjid.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Masjid</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($permissions->contains('jadwal_show'))
    <li class="menu-item {{ request()->routeIs('admin.jadwal.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-calendar-lines-pen fs-6"></i>
            <div class="text-truncate">
                Jadwal Imam
            </div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.jadwal.index', 'admin.jadwal.edit') ? 'active' : '' }}">
                <a href="{{ route('admin.jadwal.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Jadwal</div>
                </a>
            </li>
            @if ($permissions->contains('jadwal_create'))
                <li class="menu-item {{ request()->routeIs('admin.jadwal.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.jadwal.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Jadwal</div>
                    </a>
                </li>
            @endif
            <li class="menu-item {{ request()->routeIs('admin.jadwal.cache') ? 'active' : '' }}">
                <a href="{{ route('admin.jadwal.cache') }}" class="menu-link">
                    <div class="text-truncate">Bersihkan Jadwal</div>
                </a>
            </li>
        </ul>
    </li>
@endif

@if ($permissions->contains('memorization_show'))
    <li class="menu-item {{ request()->routeIs('admin.student.memorization.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-book-open fs-6"></i>
            <div class="text-truncate">
                Hafalan Santri
            </div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.student.memorization.index', 'admin.student.memorization.edit', 'admin.student.memorization.show') ? 'active' : '' }}">
                <a href="{{ route('admin.student.memorization.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Hafalan</div>
                </a>
            </li>
            @if ($permissions->contains('memorization_create'))
                <li class="menu-item {{ request()->routeIs('admin.student.memorization.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.memorization.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Hafalan</div>
                    </a>
                </li>
            @endif
            {{-- <li class="menu-item {{ request()->routeIs('admin.memorization.cache') ? 'active' : '' }}">
                <a href="{{ route('admin.memorization.cache') }}" class="menu-link">
                    <div class="text-truncate">Bersihkan Hafalan</div>
                </a>
            </li> --}}
        </ul>
    </li>
@endif

@if ($permissions->contains('bayaran_show'))
    <li
        class="menu-item {{ request()->routeIs('admin.bayaran.*', 'admin.marbot*', 'admin.bayarantambahan*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-money-bill fs-6"></i>
            <div class="text-truncate">
                Bayaran
            </div>
        </a>
        <ul class="menu-sub">
            <li
                class="menu-item {{ request()->routeIs('admin.bayaran.index', 'admin.bayaran.edit', 'admin.bayaran.list.index') ? 'active' : '' }}">
                <a href="{{ route('admin.bayaran.index') }}" class="menu-link">
                    <div class="text-truncate">Grup Bayaran</div>
                </a>
            </li>
            @if ($permissions->contains('bayaran_create'))
                <li class="menu-item {{ request()->routeIs('admin.bayaran.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.bayaran.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Bayaran</div>
                    </a>
                </li>
            @endif
            @if ($permissions->contains('marbot_show'))
                <li class="menu-item {{ request()->routeIs('admin.marbot*') ? 'active' : '' }}">
                    <a href="{{ route('admin.marbot.index') }}" class="menu-link">
                        <div class="text-truncate">Marbot</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($permissions->contains('pengumuman_show'))
    <li class="menu-item {{ request()->routeIs('admin.pengumuman.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-bullhorn fs-6"></i>
            <div class="text-truncate">
                Pengumuman
            </div>
        </a>
        <ul class="menu-sub">
            <li
                class="menu-item {{ request()->routeIs('admin.pengumuman.index', 'admin.pengumuman.edit') ? 'active' : '' }}">
                <a href="{{ route('admin.pengumuman.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Pengumuman</div>
                </a>
            </li>
            @if ($permissions->contains('pengumuman_create'))
                <li class="menu-item {{ request()->routeIs('admin.pengumuman.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengumuman.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Pengumuman</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($permissions->contains('rekap_show') || $permissions->contains('statistik_show'))
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Tools</span>
    </li>
@endif

@if ($permissions->contains('rekap_show'))
    <li class="menu-item {{ request()->routeIs('admin.rekap.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-file fs-6"></i>
            <div class="text-truncate">
                Rekap
            </div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.rekap.berdasarkan-imam.index') ? 'active' : '' }}">
                <a href="{{ route('admin.rekap.berdasarkan-imam.index') }}" class="menu-link">
                    <div class="text-truncate">Berdasarkan Imam</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.rekap.berdasarkan-shalat.index') ? 'active' : '' }}">
                <a href="{{ route('admin.rekap.berdasarkan-shalat.index') }}" class="menu-link">
                    <div class="text-truncate">Berdasarkan Shalat</div>
                </a>
            </li>
        </ul>
    </li>
@endif

@if ($permissions->contains('statistik_show'))
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
@endif

@if ($permissions->contains('quote_show'))
    <li class="menu-item {{ request()->routeIs('admin.quote.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-quote-left fs-6"></i>
            <div class="text-truncate">
                Quote
            </div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.quote.index', 'admin.quote.edit') ? 'active' : '' }}">
                <a href="{{ route('admin.quote.index') }}" class="menu-link">
                    <div class="text-truncate">Daftar Quote</div>
                </a>
            </li>
            @if ($permissions->contains('quote_create'))
                <li class="menu-item {{ request()->routeIs('admin.quote.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.quote.create') }}" class="menu-link">
                        <div class="text-truncate">Tambah Quote</div>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
