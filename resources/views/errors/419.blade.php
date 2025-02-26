<x-error>
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">419</h1>
        <h4 class="mb-2 mx-2">Sesi Habis! 🔐</h4>
        <p class="mb-6 mx-2">Maaf sesi anda sudah habis, silahkan login kembali.</p>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('clear.cookie') }}" class="btn btn-secondary">Logout</a>
        </div>
    </div>
</x-error>