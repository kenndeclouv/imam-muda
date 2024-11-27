<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Pengumuman</h5> <small class="text-body float-end">Data Pengumuman</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-target">Target</label>
                        <select name="target_id[]" class="form-control select2" id="pengumuman-target" multiple required>
                            @foreach ($targets as $target)
                                <option value="{{ $target->id }}" {{ old('target_id') == $target->id ? 'selected' : '' }}>{{ $target->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-tanggal">Tanggal</label>
                        <input type="date" name="date" class="form-control" id="pengumuman-tanggal" required value="{{ old('date') ? old('date') : now()->format('Y-m-d') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-judul">Judul</label>
                        <input type="text" name="title" class="form-control" id="pengumuman-judul" required value="{{ old('title') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-pengumuman">Pengumuman</label>
                        <textarea name="content" class="form-control" id="pengumuman-pengumuman" required>{{ old('content') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-link">Link</label>
                        <input type="text" name="link" class="form-control" id="pengumuman-link" value="{{ old('link') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-status">Status</label>
                        <select name="is_active" class="form-control select2" id="pengumuman-status" required>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }} selected>Aktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    </x-slot:js>
</x-app>
