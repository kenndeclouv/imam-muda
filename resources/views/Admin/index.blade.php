<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl-8 mb-6 order-0">
                <div class="card h-100">
                    <div class="d-flex align-items-start row">
                        <div class="col">
                            <div class="card-body">
                                <h2 class="card-title text-primary mb-3">
                                    Selamat datang {{ Auth::user()->name }} !
                                </h2>
                                <p class="mb-6">
                                    {{ \Carbon\Carbon::now()->format('d F Y H:i') }}
                                </p>

                                {{-- <a href="javascript:;" class="btn btn-sm btn-label-primary">View Badges</a> --}}
                                {{-- <div class="sk-fold sk-primary">
                                    <div class="sk-fold-cube"></div>
                                    <div class="sk-fold-cube"></div>
                                    <div class="sk-fold-cube"></div>
                                    <div class="sk-fold-cube"></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-12 mb-6">
                <div class="card h-100">
                    <div class="card-body pb-4">
                        <span class="d-block fw-medium mb-1">Jadwal Imam</span>
                        <h4 class="card-title mb-0" id="imamAktif">{{ $weeklyJadwal }}</h4>
                    </div>
                    <div id="chartImamAktif" class="pb-3"></div>
                </div>
            </div>

            <div class="col-lg-2 col-md-12 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-primary rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-user-group m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Imam</p>
                        <h4 class="card-title mb-3">{{ $imams }}</h4>
                        <small class="fw-medium">
                            @if ($percentageChange > 0)
                                <span class="text-success"><i class="fas fa-arrow-up"></i>
                                    +{{ number_format($percentageChange, 2) }}%</span>
                            @elseif($percentageChange < 0)
                                <span class="text-danger"><i class="fas fa-arrow-down"></i>
                                    {{ number_format($percentageChange, 2) }}%</span>
                            @else
                                <span class="text-muted"> 0%</span>
                            @endif
                        </small>

                    </div>
                </div>
            </div>

            <div class="col-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-info rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-mosque m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Masjid</p>
                        <h4 class="card-title mb-3">{{ $masjids }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-6">
                <div class="card h-100">
                    <div class="card-body pb-0">
                        <span class="d-block fw-medium mb-1">Revenue</span>
                        <h4 class="card-title mb-0 mb-lg-4">425k</h4>
                        <div id="revenueChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-info rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-mosque m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Masjid</p>
                        <h4 class="card-title mb-3">{{ $masjids }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-6">
                <div class="card h-100">
                    <div class="card-body pb-0">
                        <span class="d-block fw-medium mb-1">Revenue</span>
                        <h4 class="card-title mb-0 mb-lg-4">425k</h4>
                        <div id="revenueChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-sm-row flex-column gap-10">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title mb-6">
                                    <h5 class="text-nowrap mb-1">Profile Report</h5>
                                    <span class="badge bg-label-warning">YEAR 2022</span>
                                </div>
                                <div class="mt-sm-auto">
                                    <h4 class="mb-0">$84,686k</h4>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-6">
                <div class="text-center py-3 border-0 rounded-3 bg-label-primary text-nowrap d-inline-flex position-relative mb-6 w-100">
                    <h4 class="mb-0 mx-auto">Pengumuman</h4>
                    @if ($schedules->count() > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge badge-center rounded-pill bg-primary text-white">
                            {{ $schedules->count() }}
                        </span>
                    @endif
                    </div>

                <div class="card text-center">
                    <div class="card-header border-bottom mb-4 nav-align-top">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-imam" aria-controls="navs-pills-imam"
                                    aria-selected="true">
                                    Imam
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content pt-0 pb-4">
                        <div class="tab-pane fade show active" id="navs-pills-imam" role="tabpanel">
                            <div class="table-responsive text-start text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nama Imam</th>
                                            <th>Tanggal</th>
                                            <th>Shalat</th>
                                            <th>Masjid</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->Imam->fullname }}</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d F Y') }}</td>
                                                <td>{{ $schedule->Shalat->name }}</td>
                                                <td>{{ $schedule->Masjid->name }}</td>
                                                <td>{{ $schedule->note }}</td>
                                                <td>
                                                    <a href="{{ route('admin.jadwal.edit', $schedule->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-slot:js>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('/api/get-imam-schedule-data?range=7')
                    .then(response => response.json())
                    .then(data => {
                        // Pastikan format data sudah sesuai
                        console.log(data); // Debugging data jika perlu

                        const today = new Date().toISOString().split('T')[0];
                        const todayIndex = data.days.indexOf(today);
                        // Konfigurasi ApexCharts
                        var options = {
                            chart: {
                                height: 80,
                                type: 'area',
                                toolbar: {
                                    show: false
                                },
                                sparkline: {
                                    enabled: true
                                }
                            },
                            grid: {
                                show: false,
                                padding: {
                                    right: 8
                                }
                            },
                            colors: ["#28a745"],
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shade: "light",
                                    shadeIntensity: 0.8,
                                    opacityFrom: 0.8,
                                    opacityTo: 0,
                                    stops: [0, 85, 100]
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 2,
                                curve: "smooth"
                            },
                            series: [{
                                name: 'Jadwal Imam',
                                data: data.totals // Data dinamis dari API
                            }],
                            xaxis: {
                                show: false,
                                lines: {
                                    show: false
                                },
                                labels: {
                                    show: false
                                },
                                stroke: {
                                    width: 0
                                },
                                axisBorder: {
                                    show: false
                                }
                            },
                            yaxis: {
                                stroke: {
                                    width: 0
                                },
                                show: false
                            },
                            tooltip: {
                                enabled: true,
                                x: {
                                    formatter: function(val, opts) {
                                        const dayName = new Date(data.days[opts.dataPointIndex])
                                            .toLocaleDateString('id-ID', {
                                                weekday: 'long'
                                            }); // Tampilkan nama hari
                                        return dayName.charAt(0).toUpperCase() + dayName.slice(
                                            1); // Kapitalisasi awal huruf
                                    }
                                },
                                y: {
                                    formatter: function(val) {
                                        return val; // Tampilkan data imam (nama)
                                    }
                                }
                            }

                        };

                        // Render Chart
                        var chart = new ApexCharts(document.querySelector("#chartImamAktif"), options);
                        chart.render();
                    })
                    .catch(err => {
                        console.error('Error fetching data:', err);
                    });
            });
        </script>
    </x-slot:js>
</x-app>
