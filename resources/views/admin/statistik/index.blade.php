<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-header border-bottom mb-4 d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Statistik</h5>
                    <p class="card-subtitle my-0">Statistik Jadwal Imam</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <select class="form-select select2" id="imamChartDropdown">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last7days">Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                            <option value="currentmonth">Current Month</option>
                            <option value="lastmonth">Last Month</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="lineAreaChart"></div>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            function formatDates(days) {
                if (!days || !Array.isArray(days)) {
                    console.error('Data days tidak valid:', days);
                    return []; // Mengembalikan array kosong jika data tidak valid
                }
                return days.map(day => {
                    const date = new Date(day);
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        // year: 'numeric'
                    });
                });
            }

            let imamChart = null;
            // let masjidChart = null;

            // Inisialisasi grafik Imam
            function initializeImamChart(days, totals) {
                imamChart = new ApexCharts(document.querySelector("#lineAreaChart"), {
                    chart: {
                        height: 400,
                        type: "area",
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: false,
                        curve: "straight"
                    },
                    grid: {
                        borderColor: '#89898950',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    colors: ['var(--bs-primary)','var(--bs-primary-label)'],
                    series: [
                        {
                            name: "Jumlah Jadwal Imam",
                            data: totals
                        }
                    ],
                    xaxis: {
                        categories: formatDates(days),
                        labels: {
                            style: {
                                colors: '#9e9e9e',
                                fontSize: "13px"
                            }
                        },
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#9e9e9e',
                                fontSize: "13px"
                            }
                        },
                    },
                    fill: {
                        opacity: 1,
                        type: "solid"
                    },
                    tooltip: {
                        shared: false
                    },
                    legend: {
                        show: true,
                        position: "top",
                        horizontalAlign: "start",
                        labels: {
                            colors: '#9e9e9e',
                            useSeriesColors: false
                        },
                    },
                });
                imamChart.render();
            }

            // Edit data grafik Imam
            function updateImamChart(days, totals) {
                imamChart.updateSeries([{
                    name: "Jumlah Jadwal Imam",
                    data: totals
                }]);
                imamChart.updateOptions({
                    xaxis: {
                        categories: formatDates(days)
                    }
                });
            }

            // Fetch data Imam
            function fetchImamData(filter = '') {
                const url = `/api/get-imam-schedule-data${filter ? `?range=${filter}` : ''}`;

                $.getJSON(url, function(data) {
                    if (imamChart) {
                        updateImamChart(data.days, data.totals);
                    } else {
                        initializeImamChart(data.days, data.totals);
                    }
                }).fail(function() {
                    console.error('Error fetching data for Imam chart');
                });
            }


            // Document Ready
            $(document).ready(function() {
                // Event untuk dropdown Imam
                $('#imamChartDropdown').on('change', function() {
                    const filter = $(this).val();
                    fetchImamData(filter);
                });

                // Muat data awal
                fetchImamData();
            });
        </script>
    </x-slot:js>
</x-app>
