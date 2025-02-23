<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.student.memorization.index') }}">Daftar
                                Hafalan Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Hafalan Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Hafalan Santri</h5> <small class="text-body float-end">Data Hafalan
                    Santri</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('student.student.memorization.update', $memorization->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="student-id">Nama Ustadz</label>
                        <select name="imam_id" class="form-control select2" id="imam-id" required>
                            <option value="" disabled
                                {{ old('imam_id', $memorization->imam_id) ? '' : 'selected' }}>Pilih Ustadz
                            </option>
                            @foreach ($imams as $imam)
                                <option value="{{ $imam->id }}"
                                    {{ old('imam_id', $memorization->imam_id) == $imam->id ? 'selected' : '' }}>
                                    {{ $imam->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="date">Tanggal</label>
                        <input type="date" name="date" class="form-control" id="date"
                            value="{{ old('date', $memorization->date) }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="surah_number">Surah</label>
                        <select name="surah_number" class="form-control select2" id="surah_number" required>
                            @for ($i = 1; $i <= 114; $i++)
                                <option value="{{ $i }}"
                                    {{ old('surah_number', $memorization->surah_number) == $i ? 'selected' : '' }}>
                                    {{ getSurahName($i) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="from">Dari</label>
                        <input type="number" min="1" name="from" class="form-control" id="from"
                            value="{{ old('from', $memorization->from) }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="to">Sampai</label>
                        <input type="number" min="1" name="to" class="form-control" id="to"
                            value="{{ old('to', $memorization->to) }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    </x-slot:js>
</x-app>
