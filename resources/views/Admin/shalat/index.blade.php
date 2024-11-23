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

                @if ($permissions->contains('shalat_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.shalat.create') }}" class="btn btn-primary ms-auto">Tambah Shalat</a>
                    </div>
                @endif
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
                            @if ($permissions->contains('shalat_edit') || $permissions->contains('shalat_delete'))
                                <th>aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shalats as $shalat)
                            <tr>
                                <td>{{ $shalat->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($shalat->start)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shalat->end)->format('H:i') }}</td>
                                <td>{{ $shalat->updated_at->format('d F Y H:i') }}</td>
                                @if ($permissions->contains('shalat_edit') || $permissions->contains('shalat_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('shalat_edit'))
                                                <a href="{{ route('admin.shalat.edit', $shalat->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Shalat">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('shalat_delete'))
                                                <x-confirm-delete :route="route('admin.shalat.destroy', $shalat->id)" title="Hapus Shalat"
                                                    message="Apakah anda yakin ingin menghapus shalat ini?" />
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
