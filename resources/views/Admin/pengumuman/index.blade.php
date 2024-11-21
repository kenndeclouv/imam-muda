<x-app>
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

                <div class="card-actions d-flex">
                    <a href="{{ route('admin.masjid.create') }}" class="btn btn-primary ms-auto">Tambah Masjid</a>
                </div>
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
                            <th>Aksi</th>
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
                                    @endif
                                </td>
                                <td>

                                </td>
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
