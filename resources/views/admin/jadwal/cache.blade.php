<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-info rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-calendar m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Jadwal</p>
                        <h4 class="card-title mb-3">{{ $totalSchedules }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-primary rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-calendar-days m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Jadwal Bulan Ini</p>
                        <h4 class="card-title mb-3">{{ $schedulesThisMonth }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-warning rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-calendar-range m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Jadwal Tahun Ini</p>
                        <h4 class="card-title mb-3">{{ $schedulesThisYear }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-danger rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-database m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Ukuran Jadwal</p>
                        <h4 class="card-title mb-3">{{ $totalSizeInKB }} KB</h4>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start mb-4">
                            <div class="bg-danger rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-trash m-auto text-white"></i>
                            </div>
                            <h4 class="ms-3">Hapus jadwal yang telah lalu</h4>
                        </div>
                        <p class="mb-1">Hapus Jadwal</p>
                        <div class="mb-3">
                            <select id="schedule-clear-type" class="form-select select2">
                                <option value="all">Semua Jadwal</option>
                                <option value="this_year">Jadwal Tahun Ini</option>
                                <option value="this_month">Jadwal Bulan Ini</option>
                                <option value="last_month">Jadwal Bulan lalu</option>
                                <option value="last_year">Jadwal Tahun Lalu</option>
                            </select>
                        </div>
                        <button id="clear-schedules-btn" class="btn btn-primary">Hapus Jadwal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            $('.select2').select2();
            const htmlStyle = document.documentElement.getAttribute('data-style');
            const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
                '(prefers-color-scheme: dark)').matches);

            document.getElementById('clear-schedules-btn').addEventListener('click', function() {
                const type = document.getElementById('schedule-clear-type').value;

                fetch('/admin/jadwal/clear-cache', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: true,
                            confirmButtonColor: 'var(--bs-primary)',
                            background: isDarkMode ? '#2b2c40' : '#fff',
                            color: isDarkMode ? '#b2b2c4' : '#000',
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>',
                            background: isDarkMode ? '#2b2c40' : '#fff',
                            color: isDarkMode ? '#b2b2c4' : '#000',
                        });
                    });
            });
        </script>
    </x-slot:js>
</x-app>
