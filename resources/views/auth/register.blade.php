<x-auth-app title="Daftar Sebagai">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="text-center mb-4 mt-4">Jadilah bagian dari imam muda Griya Tilawah!</h3>

        <div class="row mx-0 px-lg-12 gy-6 justify-content-center">
            <!-- Basic -->
            <div class="col-12 col-xl-4 mb-md-0 ">
                <div class="card border rounded shadow-lg h-100">
                    <div class="card-body d-flex flex-column">
                        <div class=" text-center">
                            <img src="{{ asset('assets/img/pages/3d-santri.png') }}" alt="Basic Image" width="300">
                        </div>
                        <h4 class="card-title text-center text-capitalize mb-1">Santri</h4>
                        <p class="text-center mb-5">Daftar menjadi santri imam muda di griya tilawah</p>
                        <a href="{{ route('register.student') }}"
                            class="btn btn-label-success d-grid w-100 mt-auto">Jadi
                            Santri!</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mb-md-0">
                <div class="card border rounded shadow-lg h-100">
                    <div class="card-body d-flex flex-column">
                        <div class=" text-center">
                            <img src="{{ asset('assets/img/pages/3d-imam.png') }}" alt="Basic Image" width="300">
                        </div>
                        <h4 class="card-title text-center text-capitalize mb-1">Imam</h4>
                        <p class="text-center mb-5">Daftar menjadi Imam dan ustadz di imam muda griya tilawah</p>
                        <a href="{{ route('register.imam') }}" class="btn btn-label-success d-grid w-100 mt-auto">Jadi
                            Imam!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-app>
