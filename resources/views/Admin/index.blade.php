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

                                <a href="javascript:;" class="btn btn-sm btn-label-primary">View Badges</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-12 mb-6">
                <div class="card h-100">
                    <div class="card-body pb-4">
                        <span class="d-block fw-medium mb-1">Imam Aktif</span>
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
                            @if($percentageChange > 0)
                                <span class="text-success"><i class="fas fa-arrow-up"></i> +{{ number_format($percentageChange, 2) }}%</span>
                            @elseif($percentageChange < 0)
                                <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ number_format($percentageChange, 2) }}%</span>
                            @else
                                <span class="text-muted"> 0%</span>
                            @endif
                        </small>

                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-md-8 order-3 mb-6">
                <div class="card text-center h-100">
                    <div class="card-header nav-align-top">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser"
                                    aria-selected="true">
                                    Browser
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-os" aria-controls="navs-pills-os" aria-selected="false">
                                    Operating System
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-country" aria-controls="navs-pills-country"
                                    aria-selected="false">
                                    Country
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content pt-0 pb-4">
                        <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                            <div class="table-responsive text-start text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Browser</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/chrome.png" alt="Chrome"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Chrome</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">8.92k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 64.75%" aria-valuenow="64.75"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">64.75%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/safari.png" alt="Safari"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Safari</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">1.29k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 18.43%" aria-valuenow="18.43"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">18.43%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/firefox.png" alt="Firefox"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Firefox</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">328</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 8.37%" aria-valuenow="8.37"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">8.37%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/edge.png" alt="Edge"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Edge</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">142</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 6.12%" aria-valuenow="6.12"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">6.12%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/opera.png" alt="Opera"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Opera</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">82</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 2.12%" aria-valuenow="1.94"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">2.12%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/uc.png" alt="uc"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">UC Browser</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">328</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 20.14%" aria-valuenow="1.94"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">20.14%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-os" role="tabpanel">
                            <div class="table-responsive text-start text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>System</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/windows.png"
                                                        alt="Windows" height="24" class="me-3" />
                                                    <span class="text-heading">Windows</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">875.24k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 61.5%" aria-valuenow="61.50"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">61.50%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/mac.png" alt="Mac"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Mac</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">89.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 16.67%" aria-valuenow="16.67"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">16.67%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/ubuntu.png" alt="Ubuntu"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Ubuntu</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">37.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 12.82%" aria-valuenow="12.82"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">12.82%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/chrome.png" alt="Chrome"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Chrome</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">8.34k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 6.25%" aria-valuenow="6.25"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">6.25%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/cent.png" alt="Cent"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Cent</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">2.25k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 2.76%" aria-valuenow="2.76"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">2.76%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../../assets/img/icons/brands/linux.png" alt="linux"
                                                        height="24" class="me-3" />
                                                    <span class="text-heading">Linux</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">328k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 20.14%" aria-valuenow="2.76"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">20.14%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-country" role="tabpanel">
                            <div class="table-responsive text-start text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Country</th>
                                            <th>Visits</th>
                                            <th class="w-50">Data In Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-us rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">USA</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">87.24k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 38.12%" aria-valuenow="38.12"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">38.12%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-br rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">Brazil</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">42.68k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: 28.23%" aria-valuenow="28.23"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">28.23%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-in rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">India</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">12.58k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 14.82%" aria-valuenow="14.82"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">14.82%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-au rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">Australia</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">4.13k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 12.72%" aria-valuenow="12.72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">12.72%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-fr rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">France</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">2.21k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 7.11%" aria-valuenow="7.11"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">7.11%</small>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fis fi fi-ca rounded-circle fs-4 me-3"></i>
                                                    <span class="text-heading">Canada</span>
                                                </div>
                                            </td>
                                            <td class="text-heading">22.35k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height: 10px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 15.13%" aria-valuenow="7.11"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">15.13%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-6">
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
                    <div class="col-6 mb-6">
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
                                <div
                                    class="d-flex justify-content-between align-items-center flex-sm-row flex-column gap-10">
                                    <div
                                        class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
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
                </div>
            </div>
        </div>
    </div>
    <x-slot:js>
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0"></script>
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
                            markers: {
                                size: 6,
                                colors: "transparent",
                                strokeColors: "transparent",
                                strokeWidth: 4,
                                discrete: [
                                    ...(todayIndex >= 0 ? [{
                                        fillColor: "#00c292",
                                        seriesIndex: 0,
                                        dataPointIndex: todayIndex,
                                        strokeColor: "#28a745",
                                        strokeWidth: 2,
                                        size: 6,
                                        radius: 8
                                    }] : []) // Tambahkan marker hanya jika hari ini ada dalam data
                                ],
                                hover: {
                                    size: 7
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
                                name: 'imam aktif',
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
