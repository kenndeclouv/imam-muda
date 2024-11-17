<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Jadwal</h5> <small class="text-body float-end">Data Jadwal</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-imam">Nama Imam</label>
                        <input class="form-control" type="text" value="{{ $jadwal->Imam->fullname }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-shalat">Shalat</label>
                        <select name="shalat_id" class="form-control select2" id="jadwal-shalat" required>
                            @foreach ($shalats as $shalat)
                                <option value="{{ $shalat->id }}" {{ old('shalat_id', $jadwal->shalat_id) == $shalat->id ? 'selected' : '' }}>{{ $shalat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-masjid">Masjid</label>
                        <select name="masjid_id" class="form-control select2" id="jadwal-masjid" required>
                            <option value="" disabled {{ old('masjid_id', $jadwal->masjid_id) ? '' : 'selected' }}>Pilih Masjid</option>
                            @foreach ($masjids as $masjid)
                                <option value="{{ $masjid->id }}" {{ old('masjid_id', $jadwal->masjid_id) == $masjid->id ? 'selected' : '' }}>{{ $masjid->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-date">Tanggal</label>
                        <input type="datetime-local" name="date" class="form-control" id="jadwal-date" required value="{{ old('date', $jadwal->date) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">

    </x-slot:style>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>

        <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    </x-slot:js>
</x-app>
