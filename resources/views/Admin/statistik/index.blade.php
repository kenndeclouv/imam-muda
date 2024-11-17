<x-app>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Imam Aktif</h5>
                    <p class="card-subtitle my-0">Jumlah Imam yang aktif dalam jadwal</p>
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
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">Imam Aktif</h5>
                    <p class="card-subtitle my-0">Jumlah Imam yang aktif dalam jadwal</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <select class="form-select select2" id="masjidChartDropdown">
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
                <div id="masjidChart"></div>
            </div>
        </div>
    </div>
    <x-slot:js>
        {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ asset('assets/js/charts-apex.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0"></script>
        <script>
            // function formatDates(days) {
            //     if (!days || !Array.isArray(days)) {
            //         console.error('Data days tidak valid:', days);
            //         return []; // Mengembalikan array kosong jika data tidak valid
            //     }
            //     return days.map(day => {
            //         const date = new Date(day);
            //         return date.toLocaleDateString('id-ID', {
            //             day: '2-digit',
            //             month: 'short',
            //             // year: 'numeric'
            //         });
            //     });
            // }

            let imamChart = null;
            let masjidChart = null;

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
                    colors: ['#a5f8cd', '#60f2ca', '#29dac7'],
                    series: [{
                        name: "Jumlah Jadwal Imam",
                        data: totals
                    }],
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

            // Perbarui data grafik Imam
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


            // Inisialisasi grafik Masjid
            function initializeMasjidChart(days, series) {
                masjidChart = new ApexCharts(document.querySelector("#masjidChart"), {
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
                        show: true,
                        curve: "smooth" // Mengubah stroke menjadi smooth untuk grafik area
                    },
                    grid: {
                        borderColor: '#89898950',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    series: series,
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
                    colors: ['#a5f8cd', '#60f2ca', '#29dac7'],
                    fill: {
                        opacity: 1,
                        type: "solid"
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
                    tooltip: {
                        shared: false,
                        intersect: false
                    }
                });
                masjidChart.render();
            }

            // Perbarui data grafik Masjid
            function updateMasjidChart(days, series) {
                masjidChart.updateSeries(series);
                masjidChart.updateOptions({
                    xaxis: {
                        categories: formatDates(days)
                    }
                });
            }

            function formatDates(days) {
    // Pastikan days adalah array, jika bukan, ubah menjadi array kosong atau array dengan data default
    if (!Array.isArray(days)) {
        console.warn('Data "days" tidak valid, mengubah menjadi array kosong');
        days = [];  // Atau bisa kamu sesuaikan dengan data default jika ada
    }

    return days.map(function(date) {
        return new Date(date).toISOString().split('T')[0];  // Mengubah format ke YYYY-MM-DD
    });
}



            // Ambil data Masjid
            function fetchMasjidData(filter = '') {
                const url = `/api/get-masjid-shalat-schedule-data${filter ? `?range=${filter}` : ''}`;

                $.getJSON(url, function(response) {
                    // Periksa apakah data valid
                    if (!Array.isArray(response)) {
                        console.error('Data yang diterima tidak valid:', response);
                        return;
                    }

                    // Loop melalui setiap masjid dalam data
                    response.forEach(function(masjidData) {
                        const {
                            masjid,
                            days,
                            series
                        } = masjidData;

                        // Periksa apakah 'days' valid
                        if (!days || !Array.isArray(days)) {
                            console.error(`Data 'days' tidak valid untuk masjid: ${masjid}`);
                            return;
                        }

                        // Periksa apakah 'series' valid
                        if (!series || !Array.isArray(series)) {
                            console.error(`Data 'series' tidak valid untuk masjid: ${masjid}`);
                            return;
                        }

                        // Format tanggal
                        const formattedDates = formatDates(
                            days); // Pastikan formatDates berfungsi sesuai kebutuhanmu

                        // Jika chart sudah ada, update chart untuk masjid tersebut
                        if (masjidChart) {
                            updateMasjidChart(masjid, formattedDates, series);
                        } else {
                            initializeMasjidChart(masjid, formattedDates, series);
                        }
                    });

                }).fail(function() {
                    console.error('Error fetching data for Masjid chart');
                });
            }



            // Document Ready
            $(document).ready(function() {
                // Event untuk dropdown Imam
                $('#imamChartDropdown').on('change', function() {
                    const filter = $(this).val();
                    fetchImamData(filter);
                });

                // Event untuk dropdown Masjid
                $('#masjidChartDropdown').on('change', function() {
                    const filter = $(this).val();
                    fetchMasjidData(filter);
                });

                // Muat data awal
                fetchImamData();
                fetchMasjidData();
            });
        </script>
    </x-slot:js>
</x-app>
