<x-auth-app title="Login">
    <x-slot:css>
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    </x-slot:css>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') . ' logo' }}"
                                        style="border-radius:5px; width: 200px">
                                </span>
                                {{-- <span class="app-brand-text demo text-heading fw-bold">{{ config('app.name') }}</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Selamat datang Imam Muda👋</h4>
                        <p class="mb-6">Silahkan masuk menggunakan akun anda</p>
                        @include('components.alert')
                        <form id="formAuthentication" class="mb-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username" autofocus="on" value="{{ old('username') }}">
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="mb-8">
                                <div class="d-flex justify-content-between mt-8">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me"
                                            name="remember">
                                        <label class="form-check-label" for="remember-me">
                                            Ingat saya
                                        </label>
                                    </div>
                                    <a href="{{ route('password.request') }}">
                                        <span>Lupa password?</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                                <hr>
                                <p class="text-center mt-2">Belum punya akun? <a href="{{ route('register') }}"
                                        class="text-center mt-2">Daftar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-app>
