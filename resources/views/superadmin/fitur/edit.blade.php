<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.admin.index') }}">Daftar Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="bs-stepper wizard-numbered mt-2">
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
            <div class="bs-stepper-content">
                <form action="{{ route('superadmin.admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Detail Akun -->
                    <div id="account-details" class="content active dstepper-block">
                        @include('components.alert')

                        <div class="content-header mb-4">
                            <h6 class="mb-0">Detail Akun</h6>
                            <small>Masukkan Detail Akun Anda.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-sm-6">
                                <label class="form-label" for="username">Username Admin</label>
                                <input type="text" id="username" class="form-control" placeholder="johndoe"
                                    name="username" value="{{ old('username', $admin->User->username) }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control"
                                    placeholder="john.doe@email.com" aria-label="john.doe" name="email"
                                    value="{{ old('email', $admin->User->email) }}">
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
                    <div id="personal-info" class="content">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Info Pribadi</h6>
                            <small>Masukkan Info Pribadi Anda.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-sm-6">
                                <label class="form-label" for="first-name">Nama</label>
                                <input type="text" id="first-name" class="form-control"
                                    placeholder="Nama Lengkap" name="fullname"
                                    value="{{ old('fullname', $admin->fullname) }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="tempat-lahir">Tempat Lahir</label>
                                <input type="text" id="tempat-lahir" class="form-control"
                                    placeholder="Tempat Lahir" name="birthplace"
                                    value="{{ old('birthplace', $admin->birthplace) }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="tanggal-lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal-lahir" class="form-control" name="birthdate"
                                    value="{{ old('birthdate', $admin->birthdate) }}">
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev" type="button">
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
                                    placeholder="Nomor Telepon" name="phone"
                                    value="{{ old('phone', $admin->phone) }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="address">Alamat</label>
                                <input type="text" id="address" class="form-control"
                                    placeholder="Alamat Lengkap" name="address"
                                    value="{{ old('address', $admin->address) }}">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="description">Catatan</label>
                                <textarea id="description" class="form-control" placeholder="Tambahkan Catatan" rows="3" name="description">{{ old('description', $admin->description) }}</textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev" type="button">
                                    <i class="fa fa-chevron-left fa-sm ms-sm-n2 me-sm-2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                </button>
                                <button class="btn btn-warning" type="submit">Edit</button>
                            </div>
                        </div>
                    </div>
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
