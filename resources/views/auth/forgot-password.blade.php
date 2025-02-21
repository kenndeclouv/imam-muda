<x-auth-app title="Lupa Password">
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
                        <h4 class="mb-1">Lupa Password 🔑</h4>
                        <p class="mb-6">Silahkan masukkan email anda untuk mengatur ulang password</p>
                        @include('components.alert')
                        <form id="formAuthentication" class="mb-6" action="{{ route('password.email') }}"
                            method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email" autofocus="on" value="{{ old('email') }}">
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Kirim link reset
                                    password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-app>
