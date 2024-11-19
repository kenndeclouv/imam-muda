<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Bayaran</li>
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
                        <label class="form-label" for="imam-select">Pilih Imam</label>
                        <select name="imam_id[]" class="form-select select2" id="imam-select" multiple required>
                            @foreach ($imams as $imam)
                                <option value="{{ $imam->id }}">{{ $imam->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="fee">Jumlah Bayaran</label>
                        <input type="number" name="fee" class="form-control" id="fee" placeholder="Rp." value="{{ old('fee') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:style>

    </x-slot:style>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>

    </x-slot:js>
</x-app>
