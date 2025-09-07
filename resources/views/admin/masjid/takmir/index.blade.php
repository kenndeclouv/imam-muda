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
                        <li class="breadcrumb-item"><a href="{{ route('admin.masjid.index') }}">Daftar Masjid</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Takmir</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Takmir Masjid: <span class="text-primary">{{ $masjid->name }}</span></h5>
                @if ($permissions->contains('takmir_create'))
                    <a href="{{ route('admin.masjid.takmir.create', $masjid->id) }}" class="btn btn-primary">Tambah Takmir</a>
                @endif
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama User</th>
                            <th>Nama Lengkap Takmir</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Terakhir Diubah</th>
                            @if ($permissions->contains('takmir_edit') || $permissions->contains('takmir_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($takmirs as $takmir)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $takmir->user->username ?? '-' }}</td>
                                <td>{{ $takmir->user->name ?? '-' }}</td>
                                <td>{{ $takmir->fullname }}</td>
                                <td>{{ $takmir->user->email ?? '-' }}</td>
                                <td>{{ $takmir->phone ?? '-' }}</td>
                                <td>{{ Str::limit($takmir->address, 60) }}</td>
                                <td>{{ $takmir->updated_at->format('d F Y H:i') }}</td>
                                @if ($permissions->contains('takmir_edit') || $permissions->contains('takmir_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('takmir_edit'))
                                                <a href="{{ route('admin.masjid.takmir.edit', [$masjid->id, $takmir->id]) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Takmir">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('takmir_delete'))
                                                <x-confirm-delete :route="route('admin.masjid.takmir.destroy', [$masjid->id, $takmir->id])" title="Hapus Takmir"
                                                    message="Apakah anda yakin ingin menghapus takmir ini?" />
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
                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
