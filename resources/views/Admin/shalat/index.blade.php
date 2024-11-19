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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Shalat</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Shalat</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')

                <div class="card-actions d-flex">
                    <a href="{{ route('admin.shalat.create') }}" class="btn btn-primary ms-auto">Tambah Shalat</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama Shalat</th>
                            <th>Jam Mulai Shalat</th>
                            <th>Sampai Jam</th>
                            <th>terakhir diubah</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shalats as $shalat)
                            <tr>
                                <td>{{ $shalat->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($shalat->start)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shalat->end)->format('H:i') }}</td>
                                <td>{{ $shalat->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <a href="{{ route('admin.shalat.edit', $shalat->id) }}" class="btn btn-warning"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Edit Shalat">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <x-confirm-delete :route="route('admin.shalat.destroy', $shalat->id)" title="Hapus Shalat"
                                            message="Apakah anda yakin ingin menghapus shalat ini?" />
                                    </div>
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
                $('#dataTable').DataTable();
            });
        </script>
    </x-slot:js>
</x-app>
