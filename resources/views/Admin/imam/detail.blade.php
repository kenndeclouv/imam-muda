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
                        <li class="breadcrumb-item active" aria-current="page">Detail Imam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Detail Imam {{ $imam->fullname }}</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.imam.detail', $imam->id) }}" class="mb-3">
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
                            {{-- <a href="{  route('admin.rekap.imam.index') }}" class="btn btn-secondary ms-2">Reset</a> --}}
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
                            <th>masjid</th>
                            <th>shalat</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($schedules as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                                <td>{{ $item->Masjid->name }}</td>
                                <td>{{ $item->Shalat->name }}</td>
                                <td>
                                    <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-warning"><i
                                            class="fa fa-edit"></i></a>
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
                                title: "Jadwal Imam " + "{{ $imam->fullname }}" + " Bulan " +
                                    moment().format('MMMM YYYY'),
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
                                title: "Jadwal Imam " + "{{ $imam->fullname }}" + " Bulan " +
                                    moment().format('MMMM YYYY'),
                            }
                        ],
                    }],
                });
            });
        </script>
    </x-slot:js>
</x-app>
