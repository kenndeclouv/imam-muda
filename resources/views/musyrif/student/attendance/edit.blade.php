<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('musyrif.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('musyrif.student.attendance.index') }}">Daftar
                                Kehadiran Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Kehadiran Kamu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Kehadiran Santri</h5> <small class="text-body float-end">Data Kehadiran
                    Santri</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('musyrif.student.attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="student_id">Santri</label>
                        <select name="student_id" class="form-control select2" id="student_id" required>
                            <option value="" disabled>Pilih Santri</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="date">Tanggal</label>
                        <input type="date" name="date" class="form-control" id="date"
                            value="{{ old('date', $attendance->date) }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="status">Status</label>
                        <select name="status" class="form-control select2" id="status" required>
                            <option value="" disabled>Pilih Status</option>
                            <option value="hadir"
                                {{ old('status', $attendance->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="sakit"
                                {{ old('status', $attendance->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="izin" {{ old('status', $attendance->status) == 'izin' ? 'selected' : '' }}>
                                Izin</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="description">Keterangan</label>
                        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $attendance->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
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
