<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Pengumuman</h5> <small class="text-body float-end">Data Pengumuman</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.pengumuman.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-target">Target</label>
                        <input type="text" class="form-control" id="pengumuman-target"
                            value="{{ $announcement->Target->name }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-tanggal">Tanggal</label>
                        <input type="date" name="date" class="form-control" id="pengumuman-tanggal"
                            value="{{ $announcement->date }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-judul">Judul</label>
                        <input type="text" name="title" class="form-control" id="pengumuman-judul"
                            value="{{ $announcement->title }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-pengumuman">Pengumuman</label>
                        <textarea name="content" class="form-control" id="pengumuman-pengumuman" required>{{ $announcement->content }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-link">Link</label>
                        <input type="text" name="link" class="form-control" id="pengumuman-link"
                            value="{{ $announcement->link }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-photo">Foto</label>
                        <div class="row">
                            <div class="col">
                                <input type="file" name="photo" class="form-control" id="pengumuman-photo">
                            </div>
                            <div class="col">
                                @if ($announcement->photo)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#photoModal">
                                        Lihat Foto
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="photoModal" tabindex="-1"
                                        aria-labelledby="photoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="photoModalLabel">Foto Pengumuman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center border-top border-bottom my-4">
                                                    <img src="{{ $announcement->photo }}" class="rounded-3"
                                                        alt="Foto Pengumuman" style="max-width: 350px;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="pengumuman-status">Status</label>
                        <select name="is_active" class="form-control select2" id="pengumuman-status" required>
                            <option value="1" {{ $announcement->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$announcement->is_active ? 'selected' : '' }}>Tidak Aktif
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    </x-slot:js>
</x-app>
