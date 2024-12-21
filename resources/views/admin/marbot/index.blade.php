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
                        <li class="breadcrumb-item active" aria-current="page">Marbot</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Marbot</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                @if ($permissions->contains('marbot_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.marbot.create') }}" class="btn btn-primary ms-auto">Tambah
                            Marbot</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Imam</th>
                            <th>Masjid</th>
                            <th>Type</th>
                            @if ($permissions->contains('marbot_edit') || $permissions->contains('marbot_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marbots as $marbot)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $marbot->Imam->fullname }}</td>
                                <td>{{ $marbot?->Masjid->name ?? "-"}}</td>
                                <td>
                                    @if ($marbot->type == 1)
                                        Flat
                                    @elseif ($marbot->type == 2)
                                        Bonus Standby
                                    @elseif ($marbot->type == 3)
                                        Bayaran Tambahan
                                    @endif
                                </td>

                                @if ($permissions->contains('marbot_edit') || $permissions->contains('marbot_delete'))
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            @if ($permissions->contains('marbot_edit'))
                                                <a href="{{ route('admin.marbot.edit', $marbot->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Marbot">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('marbot_delete'))
                                                <x-confirm-delete :route="route('admin.marbot.destroy', $marbot->id)" title="Hapus Marbot"
                                                    message="Apakah anda yakin ingin menghapus marbot ini?" />
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
