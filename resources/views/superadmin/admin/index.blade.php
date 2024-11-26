<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Admin</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <div class="card-actions d-flex">
                    <a href="{{ route('superadmin.admin.create') }}" class="btn btn-primary ms-auto">Tambah Admin</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Terakhir diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->fullname }}</td>
                                <td>{{ $admin->User->username }}</td>
                                <td>{{ $admin->User->email }}</td>
                                <td>{{ $admin->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <a href="{{ route('superadmin.admin.edit', $admin->id) }}"
                                            class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Edit Admin">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <x-confirm-delete :route="route('superadmin.admin.destroy', $admin->id)" title="Hapus Admin" />
                                        <a href="{{ route('superadmin.admin.permissions', $admin->id) }}"
                                            class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Ijin Akses">
                                            <i class="fa-solid fa-key"></i>
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
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
