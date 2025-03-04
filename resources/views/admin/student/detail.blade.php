<x-app>
    @php
        $permissions = Auth::user()->getPermissionCodes();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Daftar Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Hafalan Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Detail Hafalan Santri {{ $student->fullname }}</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.student.detail', $student->id) }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') ?? now()->format('Y-m') }}"
                                    {{ request('month') ? 'selected' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            {{-- <a href="{  route('admin.rekap.student.index') }}" class="btn btn-secondary ms-2">Reset</a> --}}
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>surat</th>
                            <th>dari ayat</th>
                            <th>sampai ayat</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($memorizations as $memorization)
                            <tr>
                                <td>{{ formatDate($memorization->date) }}</td>
                                <td>{{ $memorization->Surat->name }}</td>
                                <td>{{ $memorization->dari_ayat }}</td>
                                <td>{{ $memorization->sampai_ayat }}</td>
                                <td>
                                    <a href="{{ route('admin.memorization.edit', $memorization->id) }}"
                                        class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                function getMonthName() {
                    const month = new URLSearchParams(window.location.search).get('month') ?
                        moment(new URLSearchParams(window.location.search).get('month')).format('MMMM YYYY') :
                        moment().locale('id').format('MMMM YYYY');

                    const monthNames = {
                        'January': 'Januari',
                        'February': 'Februari',
                        'March': 'Maret',
                        'April': 'April',
                        'May': 'Mei',
                        'June': 'Juni',
                        'July': 'Juli',
                        'August': 'Agustus',
                        'September': 'September',
                        'October': 'Oktober',
                        'November': 'November',
                        'December': 'Desember'
                    };

                    return monthNames[month.split(' ')[0]] ||
                        month; // Return the month name or the original month if not found
                }
                const date = getMonthName() + " " + (new URLSearchParams(window.location.search).get('month') ? moment(new URLSearchParams(window.location.search).get('month')).format('YYYY') : moment().format('YYYY'));
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    },
                    dom: '<"card-header flex-column justify-content-start flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-start pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [{
                        extend: "collection",
                        className: "btn btn-label-primary dropdown-toggle",
                        text: '<i class="fas fa-file-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: "print",
                                text: '<i class="fas fa-print me-1" ></i>Print',
                                className: "dropdown-item",
                                title: "Jadwal Santri " + "{{ $student->fullname }}" + " Bulan " + date,
                                exportOptions: {
                                    columns: [0, 1, 2],
                                    format: {
                                        body: function(data, row, column, node) {
                                            // jika kolom berisi tanggal
                                            if (moment(data, 'DD MMMM YYYY', true).isValid()) {
                                                return moment(data).format(
                                                    'DD'); // hanya tampilkan tanggalnya
                                            }
                                            return data; // untuk kolom lain yang bukan tanggal
                                        }
                                    }
                                },
                            },
                            {
                                extend: "excelHtml5",
                                text: '<i class="fas fa-file-excel me-1"></i>Excel',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2], // pilih kolom yang sesuai
                                    format: {
                                        body: function(data, row, column, node) {
                                            // Cek jika data adalah tanggal
                                            if (moment(data, 'DD MMMM YYYY', true).isValid()) {
                                                return moment(data).format(
                                                    'DD'); // hanya tampilkan tanggalnya
                                            }

                                            // Cek jika data adalah HTML (misalnya status dengan <span>)
                                            if ($(data).is('span')) {
                                                return $(data)
                                                    .text(); // Ambil teks tanpa HTML (misalnya "Belum dilaksanakan")
                                            }

                                            return data; // Jika bukan tanggal atau HTML, tampilkan data seperti biasa
                                        }
                                    }
                                },
                                title: "Jadwal Santri " + "{{ $student->fullname }}" + " Bulan " + date,
                            }
                        ],
                    }],
                });
            });
        </script>
    </x-slot:js>
</x-app>
