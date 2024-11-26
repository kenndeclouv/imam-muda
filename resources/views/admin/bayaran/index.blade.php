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
                        <li class="breadcrumb-item active" aria-current="page">Grup Bayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Grup Bayaran</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')

                @if ($permissions->contains('bayaran_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.bayaran.create') }}" class="btn btn-primary ms-auto">Tambah Bayaran</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bayaran</th>
                            <th>Jenis per</th>
                            <th>terakhir diubah</th>
                            @if ($permissions->contains('bayaran_edit') || $permissions->contains('bayaran_delete'))
                                <th>aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{ $fee->name }}</td>
                                <td>{{ $fee->amount }}</td>
                                <td>{{ $fee->type }}</td>
                                <td>{{ $fee->updated_at->format('d F Y H:i') }}</td>
                                @if ($permissions->contains('bayaran_edit') || $permissions->contains('bayaran_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('bayaran_edit'))
                                                <a href="{{ route('admin.bayaran.edit', $fee->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Edit Bayaran">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('bayaran_delete'))
                                                <x-confirm-delete :route="route('admin.bayaran.destroy', $fee->id)" title="Hapus Bayaran"
                                                    message="Apakah anda yakin ingin menghapus bayaran ini?" />
                                            @endif
                                            <a href="{{ route('admin.bayaran.list.index', $fee->id) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Grup Bayaran">
                                                <i class="fa-solid fa-list"></i>
                                            </a>
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
