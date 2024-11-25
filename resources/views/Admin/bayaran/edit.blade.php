<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Bayaran</li>
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
                <form action="{{ route('admin.bayaran.update', $fee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                            value="{{ old('name', $fee->name) }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="type">Jenis bayaran per</label>
                        <select name="type" class="form-select select2" id="type" disabled>
                            <option value="imam" {{ $fee->type == 'imam' ? 'selected' : '' }}>Imam</option>
                            <option value="shalat" {{ $fee->type == 'shalat' ? 'selected' : '' }}>Shalat</option>
                            <option value="masjid" {{ $fee->type == 'masjid' ? 'selected' : '' }}>Masjid</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="amount">Jumlah Bayaran</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Rp."
                            value="{{ old('amount', $fee->amount) }}" required>
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
