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
                <h5 class="card-title">Rekap Kehadiran Santri</h5>
            </div>
            <div class="card-body pb-4">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.rekap.kehadiran-santri.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') ?? now()->format('Y-m') }}"
                                    {{ request('month') ? 'selected' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Pilih Tanggal</label>
                                <input type="date" id="date" name="date" class="form-control"
                                    value="{{ request('date') ?? now()->format('Y-m-d') }}"
                                    {{ request('date') ? 'selected' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.rekap.kehadiran-santri.index') }}"
                                class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @php
            // Gabungkan semua kehadiran santri ke dalam satu array, dikelompokkan per tanggal
            $attendancesByDate = [];
            foreach ($students as $santri) {
                foreach ($santri->Attendances as $attendance) {
                    $attendancesByDate[$attendance->date][] = [
                        'santri' => $santri,
                        'attendance' => $attendance,
                    ];
                }
            }
            // Urutkan tanggal secara ascending
            ksort($attendancesByDate);
        @endphp

        @foreach ($attendancesByDate as $date => $attendances)
            <div class="card mt-3 card-border-shadow-{{ ['primary', 'secondary', 'danger', 'warning', 'info'][array_rand(['primary', 'secondary', 'danger', 'warning', 'info'])] }}"
                id="kehadiran-container-{{ Str::slug($date) }}">
                <div class="card-header border-bottom mb-4">
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-success ">
                        Tanggal: {{ formatDate($date) }}
                    </h5>
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-warning ">
                        Total Santri: {{ count($attendances) }}
                    </h5>
                </div>
                <div class="card-datatable table-responsive text-start text-nowrap">
                    <table id="kehadiranTanggal{{ Str::slug($date) }}"
                        class="table dataTable table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Santri</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $item)
                                <tr>
                                    <td>{{ $item['santri']->fullname }}</td>
                                    <td>
                                        @if ($item['attendance']->status == 'hadir')
                                            <span class="badge bg-label-success">Hadir</span>
                                        @elseif ($item['attendance']->status == 'izin')
                                            <span class="badge bg-label-info">Izin</span>
                                        @elseif ($item['attendance']->status == 'sakit')
                                            <span class="badge bg-label-warning">Sakit</span>
                                        @elseif ($item['attendance']->status == 'alpha')
                                            <span class="badge bg-label-danger">Alpha</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['attendance']->description ?? '-' }}</td>
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
        <script>
            $(document).ready(function() {
                $('[id^="kehadiranTanggal"]').each(function() {
                    const tableId = $(this).attr('id');
                    const tanggal = $(this).closest('.card').find('.card-header h5:first').text().trim();
                    const month = new URLSearchParams(window.location.search).get('month') ?
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
                                    title: "Kehadiran Tanggal " + tanggal + " Bulan " + month
                                },
                                {
                                    extend: "excelHtml5",
                                    text: '<i class="fas fa-file-excel me-1"></i>Excel',
                                    className: "dropdown-item",
                                    title: "Rekap Tanggal " + tanggal + " Bulan " + month
                                }
                            ]
                        }]
                    });
                });
                $('.select2').select2();
            });
        </script>
    </x-slot:js>
</x-app>
