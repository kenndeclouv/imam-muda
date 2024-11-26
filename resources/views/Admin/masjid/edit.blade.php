<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.masjid.index') }}">Daftar Masjid</a></li>
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
            // Retrieve coordinates from the database or set to null if not available
            var initialLat = {{ $masjid->latitude ?? 'null' }};
            var initialLng = {{ $masjid->longitude ?? 'null' }};

            // Initialize the map
            var map = L.map('map').setView([initialLat || 0, initialLng || 0], 12);

            // Check for geolocation support
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        if (!initialLat || !initialLng) {
                            map.setView([latitude, longitude], 12);
                        }
                    },
                    function() {
                        alert('Gagal mendeteksi lokasi, pilih lokasi secara manual.');
                    }
                );
            } else {
                alert('Browser kamu tidak mendukung geolokasi!');
            }

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://kenndeclouv.rf.gd">kenndeclouv</a>'
            }).addTo(map);

            // Function to update coordinate inputs
            function updateLatLngInput(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            // Function to fetch address from Nominatim API
            function updateAddress(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=id`)
                    .then(response => response.json())
                    .then(data => {
                        const address = data?.display_name || 'Alamat tidak ditemukan';
                        document.getElementById('masjid-address').value = address;
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                        document.getElementById('masjid-address').value = 'Error mengambil alamat';
                    });
            }

            // Marker initialization
            let marker;

            if (initialLat && initialLng) {
                // Create marker at initial coordinates
                marker = L.marker([initialLat, initialLng], {
                    draggable: true
                }).addTo(map);

                // Set initial values
                updateLatLngInput(initialLat, initialLng);
                updateAddress(initialLat, initialLng);

                // Marker drag event
                marker.on('moveend', function(e) {
                    const {
                        lat,
                        lng
                    } = e.target.getLatLng();
                    updateLatLngInput(lat, lng);
                    updateAddress(lat, lng);
                });
            }

            // Add marker on map click if none exists
            map.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;

                if (!marker) {
                    // Create marker
                    marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map);

                    // Marker drag event
                    marker.on('moveend', function(e) {
                        const {
                            lat,
                            lng
                        } = e.target.getLatLng();
                        updateLatLngInput(lat, lng);
                        updateAddress(lat, lng);
                    });
                } else {
                    // Move existing marker
                    marker.setLatLng([lat, lng]);
                }

                // Update inputs and address
                updateLatLngInput(lat, lng);
                updateAddress(lat, lng);
            });
        </script>
    </x-slot:js>
</x-app>
