<x-error>
    <div class="misc-wrapper text-center">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">403</h1>
        <h4 class="mb-2 mx-2">Anda tidak diizinkan! 🔐</h4>
        <p class="mb-6 mx-2">Maaf anda tidak memiliki akses ke halaman ini. Kembali ke beranda!</p>
        <a href="{{ route(str_replace('_', '', Auth::user()->Role->code) . '.home') }}" class="btn btn-primary">Kembali</a>
        <div class="mt-6">
            <img src="/assets/img/illustrations/girl-with-laptop-light.png" alt="page-misc-not-authorized-light"
                width="500" class="img-fluid" data-app-light-img="illustrations/girl-with-laptop-light.png"
                data-app-dark-img="illustrations/girl-with-laptop-dark.png">
        </div>
    </div>
</x-error>
