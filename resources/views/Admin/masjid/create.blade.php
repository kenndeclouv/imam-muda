<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Masjid</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambahkan Masjid</h5> <small class="text-body float-end">Data Masjid</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.masjid.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="form-label" for="masjid-name">Nama Masjid</label>
                        <input type="text" name="name" class="form-control" id="masjid-name"
                            placeholder="Nama Masjid" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="map">Pilih Lokasi Masjid</label>
                        <div id="map"></div>
                        <input type="hidden" id="latitude" name="latitude" required>
                        <input type="hidden" id="longitude" name="longitude" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="masjid-address">Alamat</label>
                        <textarea name="address" class="form-control" id="masjid-address" placeholder="Alamat lengkap Masjid" required>{{ old('address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #map {
                height: 400px;
                margin-bottom: 1rem;
                border-radius: 10px;
            }
        </style>
    </x-slot:style>
    <x-slot:js>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
        <script>
            // inisialisasi map
            var map = L.map('map').setView([0, 0], 5);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        map.setView([latitude, longitude], 10); // zoom ke lokasi user
                    },
                    function() {
                        alert('Gagal mendeteksi lokasi, silakan pilih secara manual.');
                    }
                );
            } else {
                alert('Browser kamu tidak mendukung geolocation!');
            }
            // tambahkan tile layer ke map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // variabel marker (default null)
            var marker = null;

            // event ketika map diklik
            map.on('click', function(e) {
                var latlng = e.latlng;

                if (!marker) {
                    // kalau marker belum ada, tambahkan
                    marker = L.marker(latlng, {
                        draggable: true
                    }).addTo(map);

                    // tambahkan event drag untuk marker
                    marker.on('moveend', function(e) {
                        var newLatLng = e.target.getLatLng();
                        updateLatLngInput(newLatLng.lat, newLatLng.lng);
                        updateAddress(newLatLng.lat, newLatLng.lng);
                    });
                } else {
                    // kalau marker udah ada, pindahkan
                    marker.setLatLng(latlng);
                }

                // update koordinat di form
                updateLatLngInput(latlng.lat, latlng.lng);

                // update alamat otomatis
                updateAddress(latlng.lat, latlng.lng);
            });

            // fungsi untuk memperbarui input koordinat
            function updateLatLngInput(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            // fungsi untuk mendapatkan alamat dari API Nominatim
            function updateAddress(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            document.getElementById('masjid-address').value = data.display_name; // isi alamat otomatis
                        } else {
                            document.getElementById('masjid-address').value = 'Alamat tidak ditemukan';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                        document.getElementById('masjid-address').value = 'Error mendapatkan alamat';
                    });
            }

            // reset input kalau marker nggak ditambahkan
            function resetInputs() {
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
                document.getElementById('masjid-address').value = '';
            }

            // event form submit
            document.querySelector('form').addEventListener('submit', function(e) {
                // kalau marker belum ditambahkan, reset input
                if (!marker) {
                    resetInputs();
                }
            });
        </script>

        {{-- <script>
            const map = L.map('map').setView([0, 0], 2); // default zoom-out
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://kenndeclouv.rf.gd">kenndeclouv</a>'
            }).addTo(map);

            let marker;

            // cek apakah geolocation tersedia
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        map.setView([latitude, longitude], 15); // zoom ke lokasi user
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;

                        marker = L.marker([latitude, longitude]).addTo(map);
                        getAddress(latitude, longitude); // ambil alamat otomatis
                    },
                    function() {
                        alert('Gagal mendeteksi lokasi, silakan pilih secara manual.');
                    }
                );
            } else {
                alert('Browser kamu tidak mendukung geolocation!');
            }

            // event klik di map
            map.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }

                getAddress(lat, lng); // ambil alamat otomatis
            });

            // fungsi untuk ambil alamat dari koordinat
            function getAddress(lat, lng) {
                const url =
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=id`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const address = data.display_name || 'Alamat tidak ditemukan';
                        document.getElementById('masjid-address').value = address;
                    })
                    .catch(error => {
                        console.error('Gagal mengambil alamat:', error);
                        alert('Gagal mengambil alamat, silakan coba lagi.');
                    });
            }
        </script> --}}
    </x-slot:js>
</x-app>
