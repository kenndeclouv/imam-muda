<x-app>
    @php
        $permissions = Auth::user()->getPermissionCodes();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kehadiran Kamu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Kehadiran Kamu</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <div class="card-actions d-flex">
                    <a href="{{ route('student.student.attendance.create') }}" class="btn btn-primary ms-auto">Tambah
                        Kehadiran</a>
                </div>

            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>
                                    <span
                                        class="badge d-block h-100 {{ $attendance->status == 'hadir' ? 'bg-success' : ($attendance->status == 'sakit' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $attendance->status }}
                                    </span>
                                </td>
                                <td>{{ $attendance->description }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <a href="{{ route('student.student.attendance.show', $attendance->id) }}"
                                            class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Detail Kehadiran">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        {{-- <a href="{{ route('student.student.attendance.edit', $attendance->id) }}"
                                            class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Edit Kehadiran">
                                            <i class="fa-solid fa-edit"></i>
                                        </a> --}}
                                        <x-confirm-delete :route="route('student.student.attendance.destroy', $attendance->id)" title="Hapus Kehadiran"
                                            message="Apakah anda yakin ingin menghapus hafalan ini?" />
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
