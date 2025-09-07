<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.masjid.index') }}">Daftar Masjid</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.masjid.takmir.index', $masjid->id) }}">Daftar Takmir</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Takmir</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Takmir</h5> <small class="text-body float-end">Data Takmir</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.masjid.takmir.update', [$masjid->id, $takmir->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Username" value="{{ $takmir->user->username ?? old('username') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="email">Email (opsional)</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Email" value="{{ $takmir->user->email ?? old('email') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="name">Nama User</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Nama User" value="{{ $takmir->user->name ?? old('name') }}" required>
                    </div>
                    <hr>
                    <div class="mb-6">
                        <label class="form-label" for="fullname">Nama Lengkap Takmir</label>
                        <input type="text" name="fullname" class="form-control" id="fullname"
                            placeholder="Nama Lengkap Takmir" value="{{ $takmir->fullname ?? old('fullname') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="phone">No. HP (opsional)</label>
                        <input type="text" name="phone" class="form-control" id="phone"
                            placeholder="No. HP" value="{{ $takmir->phone ?? old('phone') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="address">Alamat (opsional)</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Alamat Takmir">{{ $takmir->address ?? old('address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Takmir</button>
                </form>
            </div>
        </div>
    </div>
</x-app>
