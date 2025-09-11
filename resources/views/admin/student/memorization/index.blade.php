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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Hafalan Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Hafalan Santri</h5>
            </div>
            <div class="card-body pb-3">
                @include('components.alert')
                @if ($permissions->contains('memorization_create'))
                    <div class="card-actions d-flex">
                        <a href="{{ route('admin.student.memorization.create') }}"
                            class="btn btn-primary ms-auto">Tambah Hafalan</a>
                    </div>
                    <form method="GET" action="{{ route('admin.student.memorization.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-4 d-flex gap-2">
                                <div class="form-group">
                                    <label for="start_month">Dari Bulan</label>
                                    <input type="month" id="start_month" name="start_month" class="form-control"
                                        value="{{ request('start_month') ?? now()->startOfMonth()->format('Y-m') }}">
                                </div>
                                <div class="form-group">
                                    <label for="end_month">Sampai Bulan</label>
                                    <input type="month" id="end_month" name="end_month" class="form-control"
                                        value="{{ request('end_month') ?? now()->format('Y-m') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student">Pilih Santri</label>
                                    <select id="student" name="student" class="form-control select2">
                                        <option value="">Semua Santri</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}"
                                                {{ request('student') == $student->id ? 'selected' : '' }}>
                                                {{ $student->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.student.memorization.index') }}"
                                    class="btn btn-secondary ms-2">Reset</a>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        @foreach ($students as $student)
            @php
                $studentMemorizations = $memorizations->where('student_id', $student->id);
            @endphp
            <div class="card mt-3 card-border-shadow-{{ ['primary', 'secondary', 'danger', 'warning', 'info'][array_rand(['primary', 'secondary', 'danger', 'warning', 'info'])] }}"
                id="memorization-container-{{ $student->id }}">
                <div class="card-header border-bottom mb-4">
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-success ">{{ $student->fullname }}</h5>
                    <h5 class="d-inline-block px-3 py-1 rounded-3 bg-label-warning ">
                        Total Hafalan : <span
                            id="totalMemorizationStudent{{ $student->id }}">{{ $studentMemorizations->count() }}</span>
                    </h5>
                </div>
                <div class="card-datatable table-responsive text-start text-nowrap">
                    <table id="memorizationStudent{{ $student->id }}"
                        class="table dataTable table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Ustadz</th>
                                <th>Surat</th>
                                <th>Dari</th>
                                <th>Sampai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentMemorizations as $memorization)
                                <tr>
                                    <td>{{ formatDate($memorization->date) }}</td>
                                    <td>{{ $memorization->Imam->fullname }}</td>
                                    <td>{{ getSurahName($memorization->surah_number) }}</td>
                                    <td>{{ $memorization->from }}</td>
                                    <td>{{ $memorization->to }}</td>
                                    <td>
                                        <span
                                            class="badge d-block h-100 {{ is_null($memorization->is_continue) ? 'bg-warning' : ($memorization->is_continue == 1 ? 'bg-success' : 'bg-danger') }}">
                                            {{ is_null($memorization->is_continue) ? 'Belum Diperiksa' : ($memorization->is_continue == 1 ? 'Lulus' : 'Tidak Lulus') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            <a href="{{ route('admin.student.memorization.show', $memorization->id) }}"
                                                class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Detail Hafalan">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @if ($permissions->contains('memorization_edit'))
                                                <a href="{{ route('admin.student.memorization.edit', $memorization->id) }}"
                                                    class="btn btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit Hafalan">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($permissions->contains('memorization_edit'))
                                                <div class="dropdown" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-bs-title="Ubah Status">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-check-circle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.student.memorization.isContinueTrue', $memorization->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="dropdown-item text-success">Lulus</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.student.memorization.isContinueFalse', $memorization->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="dropdown-item text-danger">Tidak
                                                                    Lulus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            @if ($permissions->contains('memorization_delete'))
                                                <x-confirm-delete :route="route(
                                                    'admin.student.memorization.destroy',
                                                    $memorization->id,
                                                )" title="Hapus Hafalan"
                                                    message="Apakah anda yakin ingin menghapus hafalan ini?" />
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <x-slot:js>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('[id^="memorizationStudent"]').each(function() {
                    $(this).DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                        }
                    });
                });

                $('[id^="memorization-container-"]').each(function() {
                    const totalMemorization = $(this).find('table tbody tr').length;
                    const studentId = $(this).attr('id').replace('memorization-container-', '');
                    const totalMemorizationElement = $(`#totalMemorizationStudent${studentId}`);
                    if (totalMemorizationElement.length) {
                        totalMemorizationElement.text(totalMemorization);
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
