<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('suggestions.index') }}">Saran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Saran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title mb-0">Buat Saran Baru</h5>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('suggestions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Saran</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan judul saran">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Saran</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="5"
                                  placeholder="Tuliskan saran Anda di sini...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('suggestions.index') }}" class="btn btn-label-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Saran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
