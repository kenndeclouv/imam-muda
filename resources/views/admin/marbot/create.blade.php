<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.marbot.index') }}">Marbot</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Marbot</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Marbot</h5> <small class="text-body float-end">Data Marbot</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.marbot.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="marbot-target">Imam</label>
                        <select name="imam_id" class="form-control select2" id="marbot-imam" required>
                            <option value="">Pilih Imam</option>
                            @foreach ($imams as $imam)
                                <option value="{{ $imam->id }}" {{ old('imam_id') == $imam->id ? 'selected' : '' }}>
                                    {{ $imam->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="marbot-target">Masjid</label>
                        <select name="masjid_id" class="form-control select2" id="marbot-masjid" required>
                            <option value="">Pilih Masjid</option>
                            @foreach ($masjids as $masjid)
                                <option value="{{ $masjid->id }}"
                                    {{ old('masjid_id') == $masjid->id ? 'selected' : '' }}>
                                    {{ $masjid->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="bayaran-pokok">Bayaran Pokok</label>
                        <input type="number" class="form-control" id="bayaran-pokok" name="bayaran_pokok" required>
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
