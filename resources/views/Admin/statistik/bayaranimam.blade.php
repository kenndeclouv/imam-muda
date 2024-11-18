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
                        <li class="breadcrumb-item active" aria-current="page">Bayaran Imam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Bayaran Imam Bulan</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <form method="GET" action="{{ route('admin.statistik.bayaranimam.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Pilih Bulan</label>
                                <input type="month" id="month" name="month" class="form-control"
                                    value="{{ request('month') }}" {{ request('month') ? 'selected' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.statistik.bayaranimam.index') }}"
                                class="btn btn-secondary ms-2">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-datatable">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama Imam</th>
                            <th>Total Jadwal Imam</th>
                            <th>Total Bayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imams as $imam)
                            @php
                                $total = $imam
                                    ->schedules()
                                    ->whereYear('date', explode('-', $monthYear)[0])
                                    ->whereMonth('date', explode('-', $monthYear)[1])
                                    ->count();
                            @endphp
                            <tr>
                                <td>{{ $imam->fullname }}</td>
                                <td>{{ $total }}</td>
                                <td>Rp. {{ $total * optional($imam->Fee)->fee }}</td>
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
                $('#dataTable').DataTable();
            });
        </script>
    </x-slot:js>
</x-app>
