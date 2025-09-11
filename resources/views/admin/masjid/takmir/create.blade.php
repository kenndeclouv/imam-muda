<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.masjid.index') }}">Daftar Masjid</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Takmir</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Takmir</h5> <small class="text-body float-end">Data Takmir</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.masjid.takmir.store', $masjid->id) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                            value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="name">Nama User</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama User"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>

                    <hr>
                    <div class="mb-6">
                        <label class="form-label" for="fullname">Nama Lengkap Takmir</label>
                        <input type="text" name="fullname" class="form-control" id="fullname"
                            placeholder="Nama Lengkap Takmir" value="{{ old('fullname') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="phone">No. HP (opsional)</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="No. HP"
                            value="{{ old('phone') }}">
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="address">Alamat (opsional)</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Alamat Takmir">{{ old('address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan Takmir</button>
                </form>
            </div>
        </div>
    </div>
</x-app>
