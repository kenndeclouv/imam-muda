<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumbs --}}
        @include('components.alert')
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Imam Aktif</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Card Utama untuk Tabel Jadwal --}}
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">JADWAL TETAP</h5>
            </div>

            {{-- Tabel Jadwal --}}
            <div class="card-datatable table-responsive text-nowrap m-3">
                <table class="table table-bordered text-center" style="width: 100%;" id="dataTable">
                    <thead>
                        {{-- Header Hari --}}
                        <tr>
                            <th rowspan="2" class="align-middle">NO</th>
                            <th rowspan="2" class="align-middle">MASJID</th>
                            @foreach ($days as $dayName)
                                <th colspan="{{ count($shalats) }}">{{ $dayName }}</th>
                            @endforeach
                        </tr>
                        {{-- Header Shalat --}}
                        <tr>
                            @foreach ($days as $day)
                                @foreach ($shalats as $shalat)
                                    <th>{{ strtoupper($shalat->name) }}</th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($masjids as $index => $masjid)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $masjid->name }}</td>
                                {{-- Sel untuk setiap hari dan shalat --}}
                                @foreach (array_keys($days) as $dayKey)
                                    @foreach ($shalats as $shalat)
                                        @php
                                            $imamName = $schedules[$masjid->id][$dayKey][$shalat->id] ?? null;
                                        @endphp
                                        <td
                                            style="background-color: {{ $imamName ? getHexColor(value: $imamName) : '' }};">
                                            {{ $imamName ?? '' }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 2 + count($days) * count($shalats) }}" class="text-center">
                                    Tidak ada data untuk ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:js>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    dropdownParent: $('#modalTambahJadwalTetap, #modalHapusJadwalTetap')
                });

            });
        </script>
    </x-slot:js>
</x-app>