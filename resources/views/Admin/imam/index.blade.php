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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Imam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Imam</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <div class="card-actions d-flex">
                    <a href="{{ route('admin.imam.create') }}" class="btn btn-primary ms-auto">Tambah Imam</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Juz yang dihafal</th>
                            <th>umur</th>
                            <th>terakhir diubah</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($imams as $imam)
                            <tr>
                                <td>{{ $imam->fullname }}</td>
                                <td>{{ $imam->juz }}</td>
                                <td>{{ \Carbon\Carbon::parse($imam->birthdate)->age }}</td>
                                <td>{{ $imam->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Detail Imam"
                                            onclick="show('Detail Imam',[{label:'Nama',value:'{{ $imam->fullname }}'},{label:'Juz yang dihafal',value:'{{ $imam->juz }}'},{label:'No. Handphone',value:'{{ $imam->phone }}'},{label:'Alamat',value:'{{ $imam->address }}'}])">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.imam.edit', $imam->id) }}" class="btn btn-warning"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Edit Imam">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <x-confirm-delete :route="route('admin.imam.destroy', $imam->id)" title="Hapus Imam"
                                            message="Apakah anda yakin ingin menghapus imam ini?" />
                                        <a href="{{ route('admin.imam.index', $imam->id) }}" class="btn btn-primary"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Detail Imam">
                                            <i class="fa-solid fa-list-check"></i>
                                        </a>
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
