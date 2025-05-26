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
                        <li class="breadcrumb-item active" aria-current="page">Rekap Kehadiran Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Rekap Kehadiran Santri Bulan</h5>
            </div>
            <div class="card-body pb-4">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.rekap.berdasarkan-santri.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') ?? now()->format('Y-m') }}"
                                    {{ request('month') ? 'selected' : '' }}>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="santri">Pilih Santri</label>
                                <select id="santri" name="santri" class="form-control select2">
                                    <option value="">Semua Santri</option>
                                    @foreach ($defaultSantri as $santri)
                                        <option value="{{ $santri->id }}"
                                            {{ request('santri') == $santri->id ? 'selected' : '' }}>
                                            {{ $santri->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.rekap.berdasarkan-santri.index') }}"
                                class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($students as $santri)
        {{-- @foreach ($defaultSantri as $santri) --}}
            @php
                $totalKehadiran = $santri->Attendances->count(); // Total kehadiran santri
                $totalHadir = $santri->Attendances->filter(function ($attendance) {
                    return $attendance->status == 'hadir'; // Total hadir
                })->count();
                $totalIzin = $santri->Attendances->filter(function ($attendance) {
                    return $attendance->status == 'izin'; // Total izin
                })->count();
                $totalSakit = $santri->Attendances->filter(function ($attendance) {
                    return $attendance->status == 'sakit'; // Total sakit
                })->count();
                $totalAlpha = $santri->Attendances->filter(function ($attendance) {
                    return $attendance->status == 'alpha'; // Total alpha
                })->count();
            @endphp
            <div class="card mt-3 card-border-shadow-{{ ['primary', 'secondary', 'danger', 'warning', 'info'][array_rand(['primary', 'secondary', 'danger', 'warning', 'info'])] }}"
                id="kehadiran-container-{{ $santri->id }}">
                <div class="card-header border-bottom mb-4">
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-success ">{{ $santri->fullname }}</h5>
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-warning ">Total Kehadiran :
                        {{ $totalKehadiran }}
                    </h5>
                </div>
                <div class="card-datatable table-responsive text-start text-nowrap">
                    <table id="kehadiranSantri{{ $santri->id }}"
                        class="table dataTable table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santri->Attendances as $attendance)
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ formatDate($attendance->date) }}</td>
                                    <td>
                                        @if ($attendance->status == 'hadir')
                                            <span class="badge bg-label-success">Hadir</span>
                                        @elseif ($attendance->status == 'izin')
                                            <span class="badge bg-label-info">Izin</span>
                                        @elseif ($attendance->status == 'sakit')
                                            <span class="badge bg-label-warning">Sakit</span>
                                        @elseif ($attendance->status == 'alpha')
                                            <span class="badge bg-label-danger">Alpha</span>
                                        @endif
                                    </td>
                                    <td>{{ $attendance->description ?? '-' }}</td>
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
                $('[id^="kehadiranSantri"]').each(function() {
                    const tableId = $(this).attr('id');
                    const santriName = $(this).closest('.card').find('.card-header h5:first').text().trim();
                    const date = new URLSearchParams(window.location.search).get('month') ?
                        moment(new URLSearchParams(window.location.search).get('month')).format('MMMM YYYY') :
                        moment().locale('id').format('MMMM YYYY');

                    $(this).DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                        },
                        dom: '<"card-header flex-column justify-content-start flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-start pt-6 pt-md-0"B>>' +
                            '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t' +
                            '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        buttons: [{
                            extend: "collection",
                            className: "btn btn-label-primary dropdown-toggle",
                            text: '<i class="fas fa-file-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [{
                                    extend: "print",
                                    text: '<i class="fas fa-print me-1"></i>Print',
                                    className: "dropdown-item",
                                    title: "Kehadiran " + santriName + " Bulan " + date
                                },
                                {
                                    extend: "excelHtml5",
                                    text: '<i class="fas fa-file-excel me-1"></i>Excel',
                                    className: "dropdown-item",
                                    title: "Rekap " + santriName + " Bulan " + date
                                }
                            ]
                        }]
                    });
                });
                $('.select2').select2();

                $('[id^="kehadiran-container-"]').each(function() {
                    const totalKehadiran = $(this).find('table tbody tr').length;
                    const santriId = $(this).attr('id').replace('kehadiran-container-',
                        ''); // Ambil ID santri dari ID tabel
                    const totalKehadiranElement = $(`#totalKehadiranSantri${santriId}`);
                    if (totalKehadiranElement.length) {
                        totalKehadiranElement.text(totalKehadiran);
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
