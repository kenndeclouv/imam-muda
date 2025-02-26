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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Masjid</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Masjid</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                @if ($permissions->contains('masjid_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.masjid.create') }}" class="btn btn-primary ms-auto">Tambah Masjid</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Masjid</th>
                            <th>Alamat</th>
                            <th>terakhir diubah</th>
                            @if ($permissions->contains('masjid_edit') || $permissions->contains('masjid_delete'))
                                <th>aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masjids as $masjid)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $masjid->name }}</td>
                                <td>{{ Str::limit($masjid->address, 60) }}</td>
                                <td>{{ $masjid->updated_at->format('d F Y H:i') }}</td>
                                @if ($permissions->contains('masjid_edit') || $permissions->contains('masjid_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('masjid_edit'))
                                                <a href="{{ route('admin.masjid.edit', $masjid->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Masjid">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('masjid_delete'))
                                                <x-confirm-delete :route="route('admin.masjid.destroy', $masjid->id)" title="Hapus Masjid"
                                                    message="Apakah anda yakin ingin menghapus masjid ini?" />
                                            @endif
                                            @if ($masjid->latitude && $masjid->longitude)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ $masjid->latitude }},{{ $masjid->longitude }}"
                                                    class="btn btn-info" target="_blank" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Lihat di Google Maps">
                                                    <i class="fa-solid fa-map"></i>
                                                </a>
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
