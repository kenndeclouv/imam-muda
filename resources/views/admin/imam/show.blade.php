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
                        <li class="breadcrumb-item"><a href="{{ route('admin.imam.index') }}">Daftar Imam</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Imam</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Detail Imam</h5>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" id="fullname" class="form-control" value="{{ $imam->fullname }}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="text" id="birthdate" class="form-control"
                                value="{{ \Carbon\Carbon::parse($imam->birthdate)->format('d F Y') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" id="phone" class="form-control" value="{{ $imam->phone }}"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="juz">Juz yang dihafal</label>
                        <input type="text" id="juz" class="form-control" value="{{ $imam->juz }}" disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="school">Pendidikan terakhir</label>
                        <input type="text" id="school" class="form-control" value="{{ $imam->school ?? '-' }}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" class="form-control" value="{{ ucfirst($imam->status) }}"
                            disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="child_count">Jumlah Anak</label>
                        <input type="text" id="child_count" class="form-control" value="{{ $imam->child_count }}"
                            disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="wife_count">Jumlah Istri</label>
                        <input type="text" id="wife_count" class="form-control" value="{{ $imam->wife_count }}"
                            disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" id="address" class="form-control" value="{{ $imam->address }}"
                            disabled>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="description">Catatan</label>
                        <textarea id="description" class="form-control" rows="3" disabled>{{ $imam->description }}</textarea>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.imam.index') }}" class="btn btn-primary">Kembali</a>
                    @if ($permissions->contains('imam_edit'))
                        <form action="{{ route('admin.imam.is_active.update.false', $imam->id) }}" method="POST">
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
