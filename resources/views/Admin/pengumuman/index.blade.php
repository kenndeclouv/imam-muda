<x-app>
    @php
        $permissions = Auth::user()->Admin->getPermissionCodes();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Pengumuman</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                @if ($permissions->contains('pengumuman_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary ms-auto">Tambah
                            Pengumuman</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Pengumuman</th>
                            <th>Target</th>
                            <th>Status</th>
                            @if ($permissions->contains('pengumuman_edit') || $permissions->contains('pengumuman_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->date }}</td>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ $announcement->content }}</td>
                                <td>{{ $announcement->Target->name }}</td>
                                <td>
                                    @if ($announcement->is_active)
                                        <span class="badge bg-label-success">Aktif</span>
                                    @else
                                        <span class="badge bg-label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                @if ($permissions->contains('pengumuman_edit') || $permissions->contains('pengumuman_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('pengumuman_edit'))
                                                <a href="{{ route('admin.pengumuman.edit', $announcement->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Pengumuman">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('pengumuman_delete'))
                                                <x-confirm-delete :route="route('admin.pengumuman.destroy', $announcement->id)" title="Hapus Pengumuman"
                                                    message="Apakah anda yakin ingin menghapus pengumuman ini?" />
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
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    </x-slot:js>
</x-app>
