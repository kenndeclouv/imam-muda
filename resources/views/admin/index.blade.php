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
                                <span class="badge bg-label-primary fs-5 ">{{ Auth::user()->Role->name }}</span>

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
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-6">
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
            <div class="col-12 col-lg-3 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-primary rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-bullhorn m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Pengumuman</p>
                        <h4 class="card-title mb-3">{{ $announcements->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="bg-warning rounded-circle d-flex" style="width: 50px; height: 50px">
                                <i class="menu-icon fa-solid fa-money-bill m-auto text-white"></i>
                            </div>
                        </div>
                        <p class="mb-1">Total Bayaran Imam</p>
                        <h4 class="card-title mb-3">Rp.{{ number_format($bayaranImam ?? 0, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                            <div class="d-flex flex-column align-items-start justify-content-between text-start">
                                <div class="card-title mb-3 mb-md-6">
                                    <h5 class="text-nowrap mb-1">Quotes</h5>
                                </div>
                                <h5 class="mb-0" id="quotes">
                                    {{ $quote->content ?? 'Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya.' }}
                                </h5>
                                <span class="badge bg-label-primary mt-2 fs-6"
                                    id="quotes-author">{{ $quote->source ?? 'QS. Al-Baqarah: 286' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-6">
                <span
                    class="text-center py-3 border-0 rounded-3 bg-label-primary fs-4 fw-semibold text-nowrap d-flex mb-6 w-100">
                    <span class="mx-auto">Pengumuman</span>
                </span>

                <div class="card text-center">
                    <div class="card-header border-bottom mb-4 nav-align-top">
                        <ul class="nav nav-pills flex-column flex-md-row gap-3" role="tablist">
                            <li class="nav-item position-relative">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-pengumuman" aria-controls="navs-pills-pengumuman"
                                    aria-selected="true">
                                    Pengumuman
                                    @if ($announcements->where('is_active', true)->where('target_id', Auth::user()->Role->id)->count() > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge badge-center rounded-pill bg-info text-white">
                                            {{ $announcements->where('is_active', true)->where('target_id', Auth::user()->Role->id)->count() }}
                                        </span>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item position-relative">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-imam" aria-controls="navs-pills-imam"
                                    aria-selected="true">
                                    Imam minta Badal
                                    @if ($schedules->count() > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge badge-center rounded-pill bg-info text-white">
                                            {{ $schedules->count() }}
                                        </span>
                                    @endif
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content pt-0 pb-4">
                        <div class="tab-pane fade show active" id="navs-pills-pengumuman" role="tabpanel">
                            <div class="table-responsive text-start text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Pengumuman</th>
                                            <th>Target</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($announcements->where('is_active', true)->where('target_id', Auth::user()->Role->id) as $announcement)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($announcement->date)->format('d F Y') }}</td>
                                                <td>{{ $announcement->title }}</td>
                                                <td>{{ $announcement->content }}</td>
                                                <td>{{ $announcement->Target->name }}</td>
                                                <td>
                                                    @if ($announcement->is_active)
                                                        <span class="badge bg-label-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-label-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pengumuman.edit', $announcement->id) }}"
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
                        <div class="tab-pane fade" id="navs-pills-imam" role="tabpanel">
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
                            colors: ['var(--bs-primary)'],
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
                                data: data.totals
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


                // fetch('https://api.quotable.io/random?minLength=80&maxLength=220')
                //     .then(response => response.json())
                //     .then(data => {
                //         document.getElementById('quotes').textContent = data.content;
                //         document.getElementById('quotes-author').textContent = data.author;
                //     })
                //     .catch(err => {
                //         document.getElementById('quotes').textContent =
                //             'Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya.';
                //         document.getElementById('quotes-author').textContent = 'QS. Al-Baqarah: 286';
                //     });
            });
        </script>
    </x-slot:js>
</x-app>
