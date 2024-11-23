<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Masjid</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Masjid</h5> <small class="text-body float-end">Data Masjid</small>
            </div>
            <div class="card-body">
                @include('components.alert')
                <form action="{{ route('admin.masjid.update', $masjid->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="form-label" for="masjid-name">Nama Masjid</label>
                        <input type="text" name="name" class="form-control" id="masjid-name"
                            placeholder="Nama Masjid" value="{{ old('name', $masjid->name) }}" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="map">Pilih Lokasi Masjid</label>
                        <div id="map"></div>
                        <input type="hidden" id="latitude" name="latitude" required>
                        <input type="hidden" id="longitude" name="longitude" required>
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="masjid-address">Alamat</label>
                        <textarea name="address" class="form-control" id="masjid-address" placeholder="Alamat lengkap Masjid" required>{{ old('address', $masjid->address) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #map {
                height: 400px;
                margin-bottom: 1rem;
                border-radius: 10px;
            }
        </style>
    </x-slot:style>
    <x-slot:js>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script>
            // ambil koordinat dari database atau null kalau tidak ada
            var initialLat = {{ $masjid->latitude ?? 'null' }};
            var initialLng = {{ $masjid->longitude ?? 'null' }};

            // inisialisasi map
            var map = L.map('map').setView([initialLat, initialLng], 12);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        if (initialLat === null || initialLng === null) {
                            map.setView([latitude, longitude], 8); // zoom ke lokasi user
                        }
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
                attribution: '&copy; <a href="https://kenndeclouv.rf.gd">kenndeclouv</a>'
            }).addTo(map);

            // hanya tambahkan marker kalau koordinat ada
            if (initialLat !== null && initialLng !== null) {
                // buat marker di lokasi awal (draggable)
                var marker = L.marker([initialLat, initialLng], {
                    draggable: true
                }).addTo(map);

                // fungsi untuk memperbarui input koordinat
                function updateLatLngInput(lat, lng) {
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                }

                // fungsi untuk mendapatkan alamat dari API Nominatim
                function updateAddress(lat, lng) {
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=id`)
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

                // event ketika marker dipindah secara manual (drag)
                marker.on('moveend', function(e) {
                    var latlng = e.target.getLatLng();
                    updateLatLngInput(latlng.lat, latlng.lng);
                    updateAddress(latlng.lat, latlng.lng); // update alamat otomatis
                });

                // event ketika map diklik
                map.on('click', function(e) {
                    var latlng = e.latlng;
                    marker.setLatLng(latlng); // pindahkan marker ke lokasi klik
                    updateLatLngInput(latlng.lat, latlng.lng); // update koordinat di form
                    updateAddress(latlng.lat, latlng.lng); // update alamat otomatis
                });

                // set nilai awal input koordinat dari database
                updateLatLngInput(initialLat, initialLng);
                updateAddress(initialLat, initialLng);
            } else {
                // tambahkan event klik untuk menambahkan marker kalau koordinat kosong
                map.on('click', function(e) {
                    var latlng = e.latlng;

                    // tambahkan marker ke map
                    var marker = L.marker(latlng, {
                        draggable: true
                    }).addTo(map);

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
                                    document.getElementById('masjid-address').value = data
                                        .display_name; // isi alamat otomatis
                                } else {
                                    document.getElementById('masjid-address').value = 'Alamat tidak ditemukan';
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching address:', error);
                                document.getElementById('masjid-address').value = 'Error mendapatkan alamat';
                            });
                    }

                    // update koordinat dan alamat
                    updateLatLngInput(latlng.lat, latlng.lng);
                    updateAddress(latlng.lat, latlng.lng);

                    // tambahkan event drag untuk marker baru
                    marker.on('moveend', function(e) {
                        var latlng = e.target.getLatLng();
                        updateLatLngInput(latlng.lat, latlng.lng);
                        updateAddress(latlng.lat, latlng.lng);
                    });

                    // matikan event klik agar tidak menambahkan marker lagi
                    map.off('click');
                });
            }
        </script>

    </x-slot:js>
</x-app>
