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
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    {{-- Form Filter --}}
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('admin.jadwal.fixed.index') }}">
                            <div class="input-group">
                                <select class="form-select" name="filter_masjid">
                                    <option value="">Semua Masjid</option>
                                    @foreach ($allMasjids as $masjid)
                                        <option value="{{ $masjid->id }}"
                                            {{ request('filter_masjid') == $masjid->id ? 'selected' : '' }}>
                                            {{ $masjid->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Filter</button>
                                <a href="{{ route('admin.jadwal.fixed.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                    {{-- Tombol Tambah Jadwal --}}
                    <div class="col-md-4 text-md-end">
                        @if ($permissions->contains('jadwal_create'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalTambahJadwalTetap">
                                <i class="fa fa-plus me-2"></i> Tambah Jadwal Tetap
                            </button>
                        @endif
                        @if ($permissions->contains('jadwal_delete'))
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalHapusJadwalTetap">
                                <i class="fa fa-trash me-2"></i> Hapus
                            </button>
                        @endif
                    </div>
                </div>
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

    {{-- Modal Tambah Jadwal Tetap --}}
    <div class="modal fade" id="modalTambahJadwalTetap" tabindex="-1" aria-labelledby="modalTambahJadwalTetapLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.jadwal.fixed.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahJadwalTetapLabel">Tambah Jadwal Tetap</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="masjid_id" class="form-label">Masjid</label>
                            <select class="form-select select2" id="masjid_id" name="masjid_id" required>
                                <option value="">Pilih Masjid</option>
                                @foreach ($allMasjids as $masjid)
                                    <option value="{{ $masjid->id }}">{{ $masjid->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shalat_id" class="form-label">Shalat</label>
                            <select class="form-select select2" id="shalat_id" name="shalat_id" required>
                                <option value="">Pilih Shalat</option>
                                @foreach ($shalats as $shalat)
                                    <option value="{{ $shalat->id }}">{{ $shalat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imam_id" class="form-label">Imam</label>
                            <select class="form-select select2" id="imam_id" name="imam_id" required>
                                <option value="">Pilih Imam</option>
                                @foreach ($imams as $imam)
                                    <option value="{{ $imam->id }}">{{ $imam->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="day" class="form-label">Hari</label>
                            <select class="form-select select2" id="day" name="day" required>
                                <option value="">Pilih Hari</option>
                                <option value="monday">Senin</option>
                                <option value="tuesday">Selasa</option>
                                <option value="wednesday">Rabu</option>
                                <option value="thursday">Kamis</option>
                                <option value="friday">Jumat</option>
                                <option value="saturday">Sabtu</option>
                                <option value="sunday">Ahad</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Hapus Jadwal Tetap --}}

    {{-- Modal Hapus Jadwal Tetap --}}
    <div class="modal fade" id="modalHapusJadwalTetap" tabindex="-1" aria-labelledby="modalHapusJadwalTetapLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.jadwal.fixed.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHapusJadwalTetapLabel">Hapus Jadwal Tetap</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="masjid_id" class="form-label">Masjid</label>
                            <select class="form-select select2" id="masjid_id" name="masjid_id" required>
                                <option value="">Pilih Masjid</option>
                                @foreach ($allMasjids as $masjid)
                                    <option value="{{ $masjid->id }}">{{ $masjid->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shalat_id" class="form-label">Shalat</label>
                            <select class="form-select select2" id="shalat_id" name="shalat_id" required>
                                <option value="">Pilih Shalat</option>
                                @foreach ($shalats as $shalat)
                                    <option value="{{ $shalat->id }}">{{ $shalat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="day" class="form-label">Hari</label>
                            <select class="form-select select2" id="day" name="day" required>
                                <option value="">Pilih Hari</option>
                                <option value="monday">Senin</option>
                                <option value="tuesday">Selasa</option>
                                <option value="wednesday">Rabu</option>
                                <option value="thursday">Kamis</option>
                                <option value="friday">Jumat</option>
                                <option value="saturday">Sabtu</option>
                                <option value="sunday">Ahad</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Jadwal</button>
                    </div>
                </div>
            </form>
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
