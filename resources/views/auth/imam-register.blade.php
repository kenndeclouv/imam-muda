<x-auth-app title="Daftar Menjadi Imam">
    <div class="container-lg d-flex justify-content-center align-items-center my-5 min-vh-100">
        <div class="bs-stepper wizard-numbered mt-2 w-100">
            <div class="bs-stepper-header">
                <div class="step active" data-target="#account-details">
                    <button type="button" class="step-trigger" aria-selected="true">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Detail Akun</span>
                            <span class="bs-stepper-subtitle">Atur Detail Akun</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i class="fa fa-chevron-right"></i>
                </div>
                <div class="step" data-target="#personal-info">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Info Pribadi</span>
                            <span class="bs-stepper-subtitle">Tambahkan info pribadi</span>
                        </span>

                    </button>
                </div>
                <div class="line">
                    <i class="fa fa-chevron-right"></i>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Informasi Tambahan</span>
                            <span class="bs-stepper-subtitle">Tambahkan informasi</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content w-100">
                <form action="{{ route('register.imam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Detail Akun -->
                    <div id="account-details" class="content active dstepper-block">
                        @include('components.alert')

                        <div class="content-header mb-4">
                            <h6 class="mb-0">Detail Akun</h6>
                            <small>Masukkan Detail Akun Anda.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-sm-6">
                                <label class="form-label" for="username">Username Imam</label>
                                <input type="text" id="username" class="form-control" placeholder="imam.muda"
                                    name="username" value="{{ old('username') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control"
                                    placeholder="imam.muda@gmail.com" aria-label="imam.muda" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-sm-6 form-password-toggle">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                        placeholder="············" aria-describedby="password2" name="password">
                                    <span class="input-group-text cursor-pointer" id="password2"><i
                                            class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-6 form-password-toggle">
                                <label class="form-label" for="confirm-password">Konfirmasi Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm-password" class="form-control"
                                        placeholder="············" aria-describedby="confirm-password2"
                                        name="password_confirmation">
                                    <span class="input-group-text cursor-pointer" id="confirm-password2"><i
                                            class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev" type="button">
                                    <i class="fa fa-chevron-left fa-sm ms-sm-n2 me-sm-2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                </button>
                                <button class="btn btn-primary btn-next" type="button">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Selanjutnya</span>
                                    <i class="fa fa-chevron-right fa-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Info Pribadi -->
                    <div id="personal-info" class="content w-100">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Info Pribadi</h6>
                            <small>Masukkan Info Pribadi Anda.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-sm-6">
                                <label class="form-label" for="first-name">Nama</label>
                                <input type="text" id="first-name" class="form-control"
                                    placeholder="Nama Lengkap" name="fullname" value="{{ old('fullname') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="tempat-lahir">Tempat Lahir</label>
                                <input type="text" id="tempat-lahir" class="form-control"
                                    placeholder="Tempat Lahir" name="birthplace" value="{{ old('birthplace') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="tanggal-lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal-lahir" class="form-control" name="birthdate"
                                    value="{{ old('birthdate') }}">
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev" type="button">
                                    <i class="fa fa-chevron-left fa-sm ms-sm-n2 me-sm-2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                </button>
                                <button class="btn btn-primary btn-next" type="button">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Selanjutnya</span>
                                    <i class="fa-solid fa-chevron-right fa-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Tautan Sosial -->
                    <div id="social-links" class="content">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Informasi Tambahan</h6>
                            <small>Masukkan informasi tambahan.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-sm-6">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" id="phone" class="form-control"
                                    placeholder="Nomor Telepon" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="school">Pendidikan Terakhir</label>
                                <input type="text" id="school" class="form-control"
                                    placeholder="Pendidikan Terakhir" name="school" value="{{ old('school') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="juz">Juz yang dihafal</label>
                                <input type="number" id="juz" class="form-control"
                                    placeholder="Juz yang dihafal" min="0" max="30" name="juz"
                                    value="{{ old('juz') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="join_date">Tanggal Bergabung</label>
                                <input type="date" id="join_date" class="form-control" name="join_date"
                                    value="{{ old('join_date') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="no_rekening">Nomor Rekening</label>
                                <input type="text" id="no_rekening" class="form-control"
                                    placeholder="Nomor Rekening" name="no_rekening"
                                    value="{{ old('no_rekening') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="status">Status</label>
                                <select id="status" class="form-select" name="status">
                                    <option value="belum nikah"
                                        {{ old('status') == 'belum nikah' ? 'selected' : '' }}>
                                        Belum Nikah
                                    </option>
                                    <option value="nikah" {{ old('status') == 'nikah' ? 'selected' : '' }}>Nikah
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="child_count">Jumlah Anak</label>
                                <input type="number" id="child_count" class="form-control"
                                    placeholder="Jumlah Anak" min="0" name="child_count"
                                    value="{{ old('child_count') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="wife_count">Jumlah Istri</label>
                                <input type="number" id="wife_count" class="form-control"
                                    placeholder="Jumlah Istri" min="0" name="wife_count"
                                    value="{{ old('wife_count') }}">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="address">Alamat</label>
                                <input type="text" id="address" class="form-control"
                                    placeholder="Alamat Lengkap" name="address" value="{{ old('address') }}">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="description">Catatan</label>
                                <textarea id="description" class="form-control" placeholder="Tambahkan Catatan" rows="3" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev" type="button">
                                    <i class="fa fa-chevron-left fa-sm ms-sm-n2 me-sm-2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                </button>
                                <button class="btn btn-primary" type="submit">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot:css>
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
    </x-slot:css>
    <x-slot:js>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    </x-slot:js>
</x-auth-app>
