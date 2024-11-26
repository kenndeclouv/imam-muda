<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 mb-6 order-0">
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
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                            <div class="d-flex flex-column align-items-start justify-content-between text-start">
                                <div class="card-title mb-3 mb-md-6">
                                    <h5 class="text-nowrap mb-1">Quotes</h5>
                                </div>
                                <h5 class="mb-0" id="quotes"></h5>
                                <span class="badge bg-label-primary mt-2 fs-6" id="quotes-author"></span>
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
                                    @if ($announcements->count() > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge badge-center rounded-pill bg-info text-white">
                                            {{ $announcements->count() }}
                                        </span>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item position-relative">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-imam" aria-controls="navs-pills-imam"
                                    aria-selected="true">
                                    Imam Butuh Badal
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($announcements as $announcement)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($announcement->date)->format('d F Y') }}</td>
                                                <td>{{ $announcement->title }}</td>
                                                <td>{{ $announcement->content }}</td>
                                                <td>
                                                    <a href=""
                                                        class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
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


                fetch('https://api.quotable.io/random?minLength=80&maxLength=220')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('quotes').textContent = data.content;
                        document.getElementById('quotes-author').textContent = data.author;
                    })
                    .catch(err => {
                        document.getElementById('quotes').textContent =
                            'Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya.';
                        document.getElementById('quotes-author').textContent = 'QS. Al-Baqarah: 286';
                    });
                // fetch('/api/quote', {
                //         headers: {
                //             'Authorization': 'kenndeclouv'
                //         }
                //     })
                //     .then(response => response.json())
                //     .then(data => {
                //         document.getElementById('quotes').textContent = data.content;
                //         document.getElementById('quotes-author').textContent = data.source;
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
