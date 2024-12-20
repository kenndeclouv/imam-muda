<x-app>
    <x-slot:css>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/jquery.dataTables.min.css">
    </x-slot:css>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Imam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Rekap Imam Bulan</h5>
            </div>
            <div class="card-body pb-4">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.rekap.berdasarkan-imam.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') ?? now()->format('Y-m') }}"
                                    {{ request('month') ? 'selected' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="imam">Pilih Imam</label>
                                <select id="imam" name="imam" class="form-control select2">
                                    <option value="">Semua Imam</option>
                                    @foreach ($defaultImam as $imam)
                                        <option value="{{ $imam->id }}"
                                            {{ request('imam') == $imam->id ? 'selected' : '' }}>
                                            {{ $imam->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.rekap.berdasarkan-imam.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($imams as $imam)
            @php
                $totalJadwalReguler = $imam->Schedules
                    ->filter(function ($schedule) {
                        return !$schedule->is_badal || !$schedule->Badal; // Jadwal reguler yang tidak dibadalkan
                    })
                    ->count();
                $totalJadwalBadal = $imam->BadalSchedules->count(); // Semua jadwal badal yang diambil imam ini
                $totalJadwalRegulerDone = $imam->Schedules
                    ->filter(function ($schedule) {
                        return (!$schedule->is_badal || !$schedule->Badal) && $schedule->status == 'done'; // Jadwal reguler yang tidak dibadalkan dan status done
                    })
                    ->count();

                $totalJadwalBadalDone = $imam->BadalSchedules
                    ->filter(function ($badalSchedule) {
                        return $badalSchedule->status == 'done'; // Jadwal badal yang status done
                    })
                    ->count(); // Semua jadwal badal yang diambil imam ini

                $totalJadwalDone = $totalJadwalRegulerDone + $totalJadwalBadalDone;

                $totalJadwal = $totalJadwalReguler + $totalJadwalBadal;
                // $totalBayaran = $totalJadwalDone * $imam->ListFee->Fee->amount;
            @endphp
            <div class="card mt-3 card-border-shadow-{{ ['primary', 'secondary', 'danger', 'warning', 'info'][array_rand(['primary', 'secondary', 'danger', 'warning', 'info'])] }}"
                id="jadwal-container-{{ $imam->id }}">
                <div class="card-header border-bottom mb-4">
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-success ">{{ $imam->fullname }}</h5>
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-warning ">Total Jadwal : {{ $totalJadwal }}</h5>
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-secondary ">Total Jadwal Badal : {{ $totalJadwalBadal }}</h5>
                </div>
                <div class="card-datatable table-responsive text-start text-nowrap">
                    <table id="jadwalImam{{ $imam->id }}"
                        class="table dataTable table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Shalat</th>
                                <th>Masjid</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($imam->Schedules as $schedule)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d F Y') }}</td>
                                    <td>{{ $schedule->Shalat->name }}</td>
                                    <td>{{ $schedule->Masjid->name }}</td>
                                    <td>
                                        @if ($schedule->is_badal)
                                            @if ($schedule->Badal)
                                                <span class="badge bg-label-warning">Dibadalkan</span>
                                                <span
                                                    class="badge bg-label-info">{{ $schedule->Badal->fullname }}</span>
                                            @else
                                                <span class="badge bg-label-danger">Perlu Badal</span>
                                            @endif
                                        @endif
                                        @if ($schedule->status == 'done')
                                            <span class="badge bg-label-success">Selesai</span>
                                        @else
                                            <span class="badge bg-label-danger">Belum Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $schedule->note ?? '-' }}</td>
                                </tr>
                            @endforeach

                            @foreach ($imam->BadalSchedules as $badalSchedule)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($badalSchedule->date)->format('d F Y') }}</td>
                                    <td>{{ $badalSchedule->Shalat->name }}</td>
                                    <td>{{ $badalSchedule->Masjid->name }}</td>
                                    <td>
                                        <span class="badge bg-label-warning">Jadwal Badal</span>
                                        <span class="badge bg-label-info">{{ $badalSchedule->Imam->fullname }}</span>
                                        @if ($badalSchedule->status == 'done')
                                            <span class="badge bg-label-success">Selesai</span>
                                        @else
                                            <span class="badge bg-label-danger">Belum Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $badalSchedule->note ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

    </div>
    <x-slot:js>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        {{-- <script src="{{ asset('assets/vendor/js/forms-picker.js') }}"></script> --}}
        <script>
            $(document).ready(function() {
                $('.dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
                $('.select2').select2();

                $('[id^="jadwal-container-"]').each(function() {
                    const totalJadwal = $(this).find('table tbody tr').length;
                    const imamId = $(this).attr('id').replace('jadwal-container-',
                        ''); // Ambil ID imam dari ID tabel
                    const totalJadwalElement = $(`#totalJadwalImam${imamId}`);
                    if (totalJadwalElement.length) {
                        totalJadwalElement.text(totalJadwal);
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
