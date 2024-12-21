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
                        <li class="breadcrumb-item active" aria-current="page">Bayaran Tambahan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Bayaran Tambahan</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')

                @if ($permissions->contains('imam_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.bayarantambahan.create') }}" class="btn btn-primary ms-auto">Tambah
                            Bayaran Tambahan</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Imam</th>
                            <th>Bayaran Tambahan</th>
                            <th>Terakhir Diubah</th>
                            @if ($permissions->contains('imam_edit') || $permissions->contains('imam_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bayaranTambahan as $bayaran)
                            <tr>
                                <td>{{ $bayaran->fullname }}</td>
                                <td>{{ $bayaran->bayaran_tambahan }}</td>
                                <td>{{ $bayaran->updated_at->format('d F Y H:i') }}</td>
                                @if ($permissions->contains('imam_edit') || $permissions->contains('imam_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('imam_edit'))
                                                <a href="{{ route('admin.bayarantambahan.edit', $bayaran->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Bayaran Tambahan">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('imam_delete'))
                                                <x-confirm-delete :route="route('admin.bayarantambahan.destroy', $bayaran->id)" title="Hapus Bayaran Tambahan"
                                                    message="Apakah anda yakin ingin menghapus bayaran tambahan ini?" />
                                            @endif
                                        </div>
                                    </td>
                                @endif
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
