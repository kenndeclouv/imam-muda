<x-app>
    @include('components.alert')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Daftar Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="bs-stepper wizard-numbered mt-2">
            <div class="bs-stepper-header">
                <div class="step" data-target="#personal-info">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Buat Akun</span>
                            <span class="bs-stepper-subtitle">Buat akun untuk login.</span>
                        </span>

                    </button>
                </div>
                <div class="line">
                    <i class="fa fa-chevron-right"></i>
                </div>
                <div class="step" data-target="#social-links">
                    <button type="button" class="step-trigger" aria-selected="false">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Informasi Pribadi</span>
                            <span class="bs-stepper-subtitle">Tambahkan informasi pribadi</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content w-100">
                <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Info Pribadi -->
                    <div id="personal-info" class="content w-100">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Buat Akun</h6>
                            <small>Buat akun untuk login.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-12">
                                <label class="form-label" for="username">Username Santri</label>
                                <input type="text" id="username" class="form-control" placeholder="santri.imam.muda"
                                    name="username" value="{{ old('username') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control"
                                    placeholder="santriimammuda@gmail.com" aria-label="imam.muda" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-12 form-password-toggle">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                        placeholder="············" aria-describedby="password2" name="password">
                                    <span class="input-group-text cursor-pointer" id="password2"><i
                                            class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="col-12 form-password-toggle">
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
                    <!-- Tautan Sosial -->
                    <div id="social-links" class="content">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Informasi Tambahan</h6>
                            <small>Masukkan informasi tambahan.</small>
                        </div>
                        <div class="row g-6">
                            <div class="col-12">
                                <label class="form-label" for="first-name">Nama</label>
                                <input type="text" id="first-name" class="form-control"
                                    placeholder="Nama Lengkap" name="fullname" value="{{ old('fullname') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="tempat-lahir">Tempat Lahir</label>
                                <input type="text" id="tempat-lahir" class="form-control"
                                    placeholder="Tempat Lahir" name="birthplace" value="{{ old('birthplace') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="tanggal-lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal-lahir" class="form-control" name="birthdate"
                                    value="{{ old('birthdate') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="address">Alamat Saat Ini</label>
                                <textarea id="address" class="form-control" placeholder="Alamat lengkap tempat tinggal" name="address"
                                    rows="3">{{ old('address') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="school">Asal Sekolah</label>
                                <input type="text" id="school" class="form-control"
                                    placeholder="Pendidikan yang saat ini dijalani" name="school"
                                    value="{{ old('school') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="father_name">Nama Ayah</label>
                                <input type="text" id="father_name" class="form-control"
                                    placeholder="Nama lengkap ayah" name="father_name"
                                    value="{{ old('father_name') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="father_job">Pekerjaan Ayah</label>
                                <input type="text" id="father_job" class="form-control"
                                    placeholder="Pekerjaan ayah" name="father_job" value="{{ old('father_job') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="mother_name">Nama Ibu</label>
                                <input type="text" id="mother_name" class="form-control"
                                    placeholder="Nama lengkap ibu" name="mother_name"
                                    value="{{ old('mother_name') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="mother_job">Pekerjaan Ibu</label>
                                <input type="text" id="mother_job" class="form-control"
                                    placeholder="Pekerjaan ibu" name="mother_job" value="{{ old('mother_job') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="motivation">Motivasi Mengikuti Program</label>
                                <textarea id="motivation" class="form-control" placeholder="Jelaskan motivasi anda mengikuti program ini"
                                    name="motivation" rows="3">{{ old('motivation') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pilihan Kelas</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="class_time"
                                        id="morning_class" value="morning"
                                        {{ old('class_time') == 'morning' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="morning_class">Kelas Pagi (Senin s/d Kamis
                                        05.15 - 06.15 WIB)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="class_time"
                                        id="evening_class" value="evening"
                                        {{ old('class_time') == 'evening' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="evening_class">Kelas Malam (Senin s/d Kamis
                                        19.30 - 20.30 WIB)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pilihan Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="residence_status"
                                        id="mukim" value="mukim"
                                        {{ old('residence_status') == 'mukim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mukim">Mukim Asrama</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="residence_status"
                                        id="non_mukim" value="non_mukim"
                                        {{ old('residence_status') == 'non_mukim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="non_mukim">Non Mukim / Pulang Pergi</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Komitmen Infaq Program</label>

                                @php
                                    $infaqOptions = ['300000', '200000', '150000', '0'];
                                    $selectedInfaq = old('infaq');
                                    $isOther = !in_array($selectedInfaq, $infaqOptions);
                                @endphp

                                <!-- Input hidden buat nyimpen nilai infaq ke database -->
                                <input type="hidden" name="infaq" id="infaq_hidden"
                                    value="{{ $selectedInfaq }}">

                                @foreach ($infaqOptions as $option)
                                    <div class="form-check">
                                        <input class="form-check-input infaq-radio" type="radio" name="infaq_radio"
                                            id="infaq_{{ $option }}" value="{{ $option }}"
                                            {{ $selectedInfaq == $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="infaq_{{ $option }}">
                                            Rp. {{ number_format($option, 0, ',', '.') }} / Bulan
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input infaq-radio" type="radio" name="infaq_radio"
                                        id="infaq_other" value="other" {{ $isOther ? 'checked' : '' }}>
                                    <label class="form-check-label" for="infaq_other">Lainnya</label>
                                    <input type="number" class="form-control mt-2" id="infaq_other_amount"
                                        placeholder="Masukkan jumlah infaq"
                                        value="{{ $isOther ? $selectedInfaq : '' }}"
                                        {{ $isOther ? '' : 'disabled' }}>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="whatsapp">Nomor WhatsApp</label>
                                <input type="tel" id="whatsapp" class="form-control"
                                    placeholder="Contoh: 081234567890" name="whatsapp"
                                    value="{{ old('whatsapp') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="youtube_link">Rekaman Tilawah (Link Youtube)</label>
                                <input type="url" id="youtube_link" class="form-control"
                                    placeholder="https://youtube.com/watch?v=..." name="youtube_link"
                                    value="{{ old('youtube_link') }}">
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev" type="button">
                                    <i class="fa fa-chevron-left fa-sm ms-sm-n2 me-sm-2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                </button>
                                <button class="btn btn-primary btn-next" type="submit">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Submit</span>
                                    <i class="fa-solid fa-chevron-right fa-sm me-sm-n2"></i>
                                </button>
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
        <script>
            $(document).ready(function() {
                $('#status').select2();
                const radioButtons = document.querySelectorAll('.infaq-radio');
                const otherAmount = document.getElementById('infaq_other_amount');
                const hiddenInput = document.getElementById('infaq_hidden');

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === "other") {
                            otherAmount.removeAttribute('disabled');
                            otherAmount.focus();
                        } else {
                            otherAmount.setAttribute('disabled', 'disabled');
                            otherAmount.value = '';
                            hiddenInput.value = this.value;
                        }
                    });
                });

                otherAmount.addEventListener('input', function() {
                    if (document.getElementById('infaq_other').checked) {
                        hiddenInput.value = this.value;
                    }
                });
            });
        </script>
    </x-slot:js>
</x-app>
