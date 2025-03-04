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
                        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Daftar Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Detail Santri</h5>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" id="fullname" class="form-control" value="{{ $student->fullname }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="birthplace">Tempat Lahir</label>
                            <input type="text" id="birthplace" class="form-control"
                                value="{{ $student->birthplace }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="text" id="birthdate" class="form-control"
                                value="{{ \Carbon\Carbon::parse($student->birthdate)->format('d F Y') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="whatsapp">Nomor WhatsApp</label>
                            <input type="text" id="whatsapp" class="form-control" value="{{ $student->whatsapp }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="school">Sekolah</label>
                            <input type="text" id="school" class="form-control" value="{{ $student->school }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="father_name">Nama Ayah</label>
                            <input type="text" id="father_name" class="form-control"
                                value="{{ $student->father_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="father_job">Pekerjaan Ayah</label>
                            <input type="text" id="father_job" class="form-control"
                                value="{{ $student->father_job }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="mother_name">Nama Ibu</label>
                            <input type="text" id="mother_name" class="form-control"
                                value="{{ $student->mother_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="mother_job">Pekerjaan Ibu</label>
                            <input type="text" id="mother_job" class="form-control"
                                value="{{ $student->mother_job }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="class_time">Waktu Kelas</label>
                            <input type="text" id="class_time" class="form-control"
                                value="{{ $student->class_time == 'morning' ? 'Pagi' : 'Malam' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="residence_status">Status Tempat Tinggal</label>
                            <input type="text" id="residence_status" class="form-control"
                                value="{{ $student->residence_status == 'mukim' ? 'Mukim' : 'Non-Mukim' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="infaq">Infaq</label>
                            <input type="text" id="infaq" class="form-control" value="{{ $student->infaq }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="youtube_link">Link Youtube</label>
                            <input type="text" id="youtube_link" class="form-control"
                                value="{{ $student->youtube_link ?? '-' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" class="form-control" rows="3" disabled>{{ $student->address ?? '-' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="motivation">Motivasi</label>
                            <textarea id="motivation" class="form-control" rows="3" disabled>{{ $student->motivation ?? '-' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.student.index') }}" class="btn btn-primary">Kembali</a>
                    @if ($permissions->contains('student_edit'))
                        <form action="{{ route('admin.student.is_active.update.false', $student->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app>
