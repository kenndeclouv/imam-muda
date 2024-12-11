<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('imam.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('imam.jadwal.index') }}">Daftar Jadwal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Jadwal</h5> <small class="text-body float-end">Data Jadwal</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('imam.jadwal.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="imam_id" value="{{ Auth::user()->Imam->id }}">
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-masjid">Masjid</label>
                        <select name="masjid_id" class="form-control select2" id="jadwal-masjid" required>
                            <option value="" disabled {{ old('masjid_id') ? '' : 'selected' }}>Pilih Masjid</option>
                            @foreach ($masjids as $masjid)
                                <option value="{{ $masjid->id }}" {{ old('masjid_id') == $masjid->id ? 'selected' : '' }}>{{ $masjid->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-shalat">Shalat</label>
                        <select name="shalat_id[]" class="form-control select2" id="jadwal-shalat" multiple required>
                            @foreach ($shalats as $shalat)
                                <option value="{{ $shalat->id }}" {{ in_array($shalat->id, old('shalat_id', [])) ? 'selected' : '' }}>{{ $shalat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="jadwal-date">Tanggal</label>
                        <input type="date" name="date" class="form-control" id="jadwal-date" required value="{{ old('date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
                $('#jadwal-shalat').on('change', function() {
                    var selectedShalat = $(this).find('option:selected').text();
                    var masjidSelect = $('#jadwal-masjid');

                    if (selectedShalat.includes('-')) {
                        var masjidName = selectedShalat.split('-')[1].trim();

                        masjidSelect.find('option').each(function() {
                            if ($(this).text().trim() === masjidName) {
                                $(this).prop('selected', true).trigger('change');
                            }
                        });
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
