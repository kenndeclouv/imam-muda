<x-app>
    @php
        $permissions = Auth::user()->getPermissionCodes();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('musyrif.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kehadiran Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title">Detail Kehadiran Santri</h5>
                <span
                    class="badge d-block h-100 {{ is_null($attendance->status) ? 'bg-warning' : ($attendance->status == 'hadir' ? 'bg-success' : 'bg-danger') }}">
                    {{ is_null($attendance->status) ? 'Belum Diperiksa' : ($attendance->status == 'hadir' ? 'Hadir' : 'Tidak Hadir') }}
                </span>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input type="text" id="date" class="form-control"
                                value="{{ formatDate($attendance->date) }}" disabled>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="student_id">Santri</label>
                            <input type="text" id="student_id" class="form-control"
                                value="{{ $attendance->Student->fullname }}" disabled>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="description">Alasan</label>
                            <textarea name="description" id="description" class="form-control" disabled>{{ $attendance->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('musyrif.student.attendance.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app>
