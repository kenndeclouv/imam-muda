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
                        <li class="breadcrumb-item"><a href="{{ route('student.student.memorization.index') }}">Daftar
                                Hafalan
                                Kamu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Hafalan Kamu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title">Detail Hafalan Kamu</h5>
                <span
                    class="badge d-block h-100 {{ is_null($memorization->is_continue) ? 'bg-warning' : ($memorization->is_continue == 1 ? 'bg-success' : 'bg-danger') }}">
                    {{ is_null($memorization->is_continue) ? 'Belum Diperiksa' : ($memorization->is_continue == 1 ? 'Lulus' : 'Tidak Lulus') }}
                </span>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="imam_id">Ustadz</label>
                            <input type="text" id="imam_id" class="form-control"
                                value="{{ $memorization->Imam->fullname }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="surah_number">Surah</label>
                            <input type="text" id="surah_number" class="form-control"
                                value="{{ getSurahName($memorization->surah_number) }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="from">Dari</label>
                            <input type="text" id="from" class="form-control" value="{{ $memorization->from }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="to">Sampai</label>
                            <input type="text" id="to" class="form-control" value="{{ $memorization->to }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">

                            <label for="date">Tanggal</label>
                            <input type="text" id="date" class="form-control"
                                value="{{ formatDate($memorization->date) }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('student.student.memorization.index') }}" class="btn btn-primary">Kembali</a>
                    {{-- @if ($permissions->contains('memorization_edit'))
                        <form action="{{ route('student.student.memorization.update.false', $memorization->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                        </form>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app>
