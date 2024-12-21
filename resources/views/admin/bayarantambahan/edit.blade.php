<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.bayarantambahan.index') }}">Bayaran Tambahan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Bayaran Tambahan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Bayaran</h5> <small class="text-body float-end">Data Bayaran</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.bayarantambahan.update', $bayaranTambahan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="imam_id">Pilih Imam</label>
                        <select name="imam_id" id="imam_id" class="form-control select2" required>
                            <option value="">Pilih Imam</option>
                            @foreach ($imams as $imam)
                                <option value="{{ $imam->id }}" {{ (old('imam_id') ?? $bayaranTambahan->id) == $imam->id ? 'selected' : '' }}>
                                    {{ $imam->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="bayaran_tambahan">Jumlah Bayaran Tambahan</label>
                        <input type="number" name="bayaran_tambahan" class="form-control" id="bayaran_tambahan" placeholder="Rp."
                            value="{{ old('bayaran_tambahan', $bayaranTambahan->bayaran_tambahan) }}" required min="0">
                    </div>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            $('.select2').select2();
        </script>
    </x-slot:js>
</x-app>
