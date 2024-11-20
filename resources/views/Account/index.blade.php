<x-app>
    @php
        $user = Auth::user();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <div class="user-profile-header-banner">
                        <img src="/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top"
                            class="w-100">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                        <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                            <img src="{{ $user->photo ?? '/assets/img/avatars/1.png' }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                        </div>
                        <div class="flex-grow-1 mt-3 mt-lg-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="mb-2 mt-lg-7">{{ ucfirst($user->name) }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                        <li class="list-inline-item">
                                            <span class="fw-medium">{{ ucfirst($user->Role->name ?? '-') }}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="fw-medium">{{ $user->email }}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="fw-medium">Terdaftar
                                                {{ $user->created_at->format('F Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-primary mb-1"
                                    onclick="event.preventDefault(); showLogoutConfirm();">
                                    <i class="fa fa-sign-out-alt fa-sm me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- User Profile Content -->
        @include('components.alert')
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-6 ">
                    <div class="card-body">
                        <small class="card-text text-uppercase text-muted small">About</small>
                        <div class="row mt-3">
                            <div class="col"><i class="text-primary fa fa-user me-2"></i> Nama</div>
                            <div class="col">: {{ $user->name ?? '-' }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col"><i class="text-success fa fa-user me-2"></i> Username</div>
                            <div class="col">: {{ $user->username }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col"><i class="text-info fa fa-crown me-2"></i> Role</div>
                            <div class="col">: {{ $user->Role->name ?? '-' }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col"><i class="text-secondary fa fa-envelope me-2"></i> Email</div>
                            <div class="col">: {{ $user->email }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col"><i class="text-warning fa fa-calendar-alt me-2"></i> Terdaftar
                            </div>
                            <div class="col">: {{ $user->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
                <!--/ About User -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <form action="{{ route('account.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Activity Timeline -->
                    <div class="card mb-6">
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                <img src="{{ $user->photo ?? '/assets/img/avatars/1.png' }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="fa fa-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden=""
                                            name="photo" accept="photo/*">
                                    </label>

                                    <div>Diizinkan JPG, JPEG, GIF atau PNG. Ukuran maksimum 5 Mb</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-6">
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label for="name" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $user->name }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        value="{{ $user->username }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" name="email" id="email"
                                        value="{{ $user->email }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-label-secondary">Batalkan</button>
                            </div>
                        </div>

                        <!-- /Account -->
                    </div>
                    <!--/ Activity Timeline -->
                    <div class="card mb-6">
                        <h5 class="card-header border-bottom mb-4">Ganti Password</h5>
                        <div class="card-body">
                            <form id="formChangePassword" method="GET" onsubmit="return false"
                                class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <h5 class="alert-heading mb-1">Pastikan bahwa persyaratan ini terpenuhi</h5>
                                    <span>Minimal 8 karakter, huruf besar &amp; simbol</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="row gx-6">
                                    <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                                        <label class="form-label" for="newPassword">New Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="newPassword"
                                                name="password" placeholder="············">
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="fa fa-eye-slash"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                                        <label class="form-label" for="confirmPassword">Confirm New
                                            Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" name="password_confirm"
                                                id="confirmPassword" placeholder="············">
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="fa fa-eye-slash"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Ganti
                                            Password</button>
                                    </div>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </form>
                @if ($user->Role->code === 'imam')
                    {{-- Imam --}}
                    <form action="{{ route('imam.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card mb-6">
                            <!-- Account -->
                            <h5 class="card-header border-bottom mb-4">Informasi Tambahan</h5>
                            <div class="card-body pt-4">
                                <div class="row g-6">
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" id="fullname" name="fullname"
                                            value="{{ $user->Imam->fullname ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input class="form-control" type="text" id="phone" name="phone"
                                            value="{{ $user->Imam->phone ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="birthplace" class="form-label">Birthplace</label>
                                        <input class="form-control" type="text" id="birthplace" name="birthplace"
                                            value="{{ $user->Imam->birthplace ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input class="form-control" type="date" id="birthdate" name="birthdate"
                                            value="{{ $user->Imam->birthdate ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="juz" class="form-label">Juz</label>
                                        <input class="form-control" type="number" id="juz" name="juz"
                                            value="{{ $user->Imam->juz ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-plugins-icon-container">
                                        <label for="school" class="form-label">School</label>
                                        <input class="form-control" type="text" id="school" name="school"
                                            value="{{ $user->Imam->school ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class=" fv-plugins-icon-container">
                                        <label for="address" class="form-label">Address</label>
                                        <input class="form-control" type="text" id="address" name="address"
                                            value="{{ $user->Imam->address ?? '-' }}">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="fv-plugins-icon-container">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ $user->Imam->description ?? '-' }}</textarea>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3">Simpan Perubahan</button>
                                    <button type="reset" class="btn btn-label-secondary">Batalkan</button>
                                </div>
                            </div>
                            <!-- /Account -->
                        </div>
                    </form>
                    {{-- / Imam --}}
                @endif
            </div>
        </div>
        <!--/ User Profile Content -->

    </div>
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}">
    </x-slot:style>
    <x-slot:js>
        <script>
            document.getElementById('upload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('uploadedAvatar').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            function showLogoutConfirm() {
                const htmlStyle = document.documentElement.getAttribute('data-style');
                const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches);
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah anda yakin ingin logout dari akun ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Tidak',
                    background: isDarkMode ? '#2b2c40' : '#fff',
                    color: isDarkMode ? '#b2b2c4' : '#000',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>
    </x-slot:js>
</x-app>
