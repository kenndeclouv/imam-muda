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
                <form method="GET" action="{{ route('admin.rekap.berdasarkan-shalat.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') ?? now()->format('Y-m') }}">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.rekap.berdasarkan-shalat.index') }}"
                                class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div
            class="card mt-3 card-border-shadow-{{ collect(['primary', 'secondary', 'danger', 'warning', 'info'])->random() }}">
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table id="jadwalImam"
                    class="table dataTable table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Imam</th>
                            @foreach ($defaultShalat as $shalat)
                                <th>{{ $shalat->name }}</th>
                            @endforeach
                            <th>Total</th>
                            <th>Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($defaultImam as $imam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $imam->fullname }}</td>
                                @foreach ($defaultShalat as $shalat)
                                    <td>
                                        {{ $groupedSchedules[$imam->id][$shalat->id]['count'] ?? 0 }}
                                    </td>
                                @endforeach
                                <td>{{ $groupedSchedules[$imam->id]['total']['count'] ?? 0 }}</td>
                                <td>Rp
                                    {{ number_format($groupedSchedules[$imam->id]['total']['salary'] ?? 0, 0, ',', '.') }}
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
                if (!$.fn.DataTable.isDataTable('#jadwalImam')) {
                    const table = $('#jadwalImam').DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json",
                        },
                        dom: '<"card-header flex-column justify-content-start flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-start pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        buttons: [{
                            extend: "collection",
                            className: "btn btn-label-primary dropdown-toggle",
                            text: '<i class="fas fa-file-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [{
                                    extend: "print",
                                    text: '<i class="fas fa-print me-1"></i>Print',
                                    className: "dropdown-item",
                                    title: "Jadwal Imam Bulan " + moment().format('MMMM YYYY'),
                                    customize: function(win) {
                                        $(win.document.body)
                                            .find('table')
                                            .append($('#jadwalImam tfoot').clone());
                                    },
                                },
                                {
                                    extend: "excelHtml5",
                                    text: '<i class="fas fa-file-excel me-1"></i>Excel',
                                    className: "dropdown-item",
                                    title: "Rekap Imam Bulan " + moment().format('MMMM YYYY'),
                                },
                            ],
                        }, ],
                        drawCallback: function() {
                            calculateTotals();
                        },
                    });

                    function calculateTotals() {
                        // hapus elemen `tfoot` jika ada sebelumnya
                        $('#jadwalImam tfoot').remove();

                        const totals = [];

                        table.columns().every(function(index) {
                            if (index === 0) {
                                totals.push('Total');
                            } else {
                                const total = this.data().reduce((sum, value) => {
                                    const numericValue = parseInt(value?.toString().replace(/[^0-9]/g,
                                        '')) || 0;
                                    return sum + numericValue;
                                }, 0);

                                totals.push(index === table.columns().count() - 1 ?
                                    `Rp ${total.toLocaleString('id-ID')}` : total);
                            }
                        });

                        $('#jadwalImam').append(`
                            <tfoot>
                                <tr>
                                    ${totals.map((total) => `<th>${total}</th>`).join('')}
                                </tr>
                            </tfoot>
                        `);
                    }
                }
                $('.select2').select2();
            });
        </script>
    </x-slot:js>
</x-app>
