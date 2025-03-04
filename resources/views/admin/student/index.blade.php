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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Santri</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                @if ($permissions->contains('student_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.student.create') }}" class="btn btn-primary ms-auto">Tambah Santri</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Bulanan</th>
                            <th>Status</th>
                            <th>terakhir diubah</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    @include('components.show')
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>{{ $student->class_time == 'morning' ? 'Pagi' : 'Malam' }}</td>
                                <td>{{ indonesianCurrency($student->infaq) }}</td>
                                <td>{{ $student->residence_status == 'mukim' ? 'Mukim' : 'Non-Mukim' }}</td>
                                <td>{{ $student->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2" aria-label="Basic example">
                                        <a href="{{ route('admin.student.show', $student->id) }}" class="btn btn-info"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Detail Santri">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @if ($permissions->contains('student_edit'))
                                            <a href="{{ route('admin.student.edit', $student->id) }}"
                                                class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Edit Santri">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
                                        @if ($permissions->contains('student_delete'))
                                            <x-confirm-delete :route="route('admin.student.destroy', $student->id)" title="Hapus Santri"
                                                message="Apakah anda yakin ingin menghapus student ini?" />
                                        @endif
                                        {{-- @if ($permissions->contains('student_detail'))
                                            <a href="{{ route('admin.student.detail', $student->id) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Detail Santri">
                                                <i class="fa-solid fa-list-check"></i>
                                            </a>
                                        @endif --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>{{ indonesianCurrency($students->sum('infaq')) }}</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
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
