<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Musyrif</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Musyrif</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <div class="card-actions d-flex">
                    <a href="{{ route('admin.musyrif.create') }}" class="btn btn-primary ms-auto">Tambah Musyrif</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Terakhir diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($musyrifs as $musyrif)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $musyrif->fullname }}</td>
                                <td>{{ $musyrif->User->username }}</td>
                                <td>{{ $musyrif->User->email }}</td>
                                <td>{{ $musyrif->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <a href="{{ route('admin.musyrif.edit', $musyrif->id) }}"
                                            class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Edit Musyrif">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <x-confirm-delete :route="route('admin.musyrif.destroy', $musyrif->id)" title="Hapus Musyrif" />
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
