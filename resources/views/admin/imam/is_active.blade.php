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
                @if ($permissions->contains('imam_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.imam.create') }}" class="btn btn-primary ms-auto">Tambah Imam</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>terakhir diubah</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($imams as $imam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $imam->fullname }}</td>
                                <td>{{ $imam->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <form action="{{ route('admin.imam.is_active.update', $imam->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Aktifkan Imam">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                            @if ($permissions->contains('imam_delete'))
                                                <x-confirm-delete :route="route('admin.imam.destroy', $imam->id)" title="Hapus Imam"
                                                    message="Apakah anda yakin ingin menghapus imam ini?" />
                                            @endif
                                        </form>
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
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
