<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('imam.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Jadwal</h5> <small class="text-body float-end">Data Jadwal</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('imam.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                    {{-- <div class="mb-6">
                        <label class="form-label" for="jadwal-status">Status</label>
                        <div id="jadwal-status">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-to_do" value="to_do" {{ old('status', $jadwal->status) == 'to_do' ? 'checked' : '' }} checked>
                                <label class="form-check-label" for="status-to_do">
                                    Akan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-done" value="done" {{ old('status', $jadwal->status) == 'done' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-done">
                                    Selesai
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-is_badal">Membutuhkan Badal?</label>
                        <div id="jadwal-is_badal">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_badal" id="is_badal-yes" value="1" {{ old('is_badal', $jadwal->is_badal) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_badal-yes">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_badal" id="is_badal-no" value="0" {{ old('is_badal', $jadwal->is_badal) == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_badal-no">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-badal">Imam Badal</label>
                        <select name="badal_id" class="form-control select2" id="jadwal-badal">
                            <option value="" disabled {{ old('badal_id', $jadwal->badal_id) ? '' : 'selected' }}>Pilih Imam Badal</option>
                            @foreach ($imams as $imam)
                                <option value="{{ $imam->id }}" {{ old('badal_id', $jadwal->badal_id) == $imam->id ? 'selected' : '' }}>{{ $imam->fullname }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-note">Keterangan</label>
                        <input type="text" name="note" class="form-control" id="jadwal-note" value="{{ old('note', $jadwal->note) }}">
                    </div>
                    <button type="submit" class="btn btn-warning">Edit</button>
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
