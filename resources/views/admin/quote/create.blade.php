<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.quote.index') }}">Daftar Quote</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Quote</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Quote</h5> <small class="text-body float-end">Data Quote</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.quote.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="quote-content">Konten Quote</label>
                        <textarea name="content" class="form-control" id="quote-content" placeholder="Konten Quote" required>{{ old('content') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="quote-source">Sumber Quote</label>
                        <input type="text" name="source" class="form-control" id="quote-source" placeholder="Sumber Quote" value="{{ old('source') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</x-app>
