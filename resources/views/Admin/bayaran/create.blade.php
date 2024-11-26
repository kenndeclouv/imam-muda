<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.bayaran.index') }}">Grup Bayaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Bayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Bayaran</h5> <small class="text-body float-end">Data Bayaran</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.bayaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="type">Jenis bayaran per</label>
                        <select name="type" class="form-select select2" id="type" required>
                            <option value="" selected disabled>Pilih Jenis</option>
                            <option value="imam">Imam</option>
                            <option value="shalat">Sholat</option>
                            <option value="masjid">Masjid</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="amount">Jumlah Bayaran</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Rp." value="{{ old('amount') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
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
