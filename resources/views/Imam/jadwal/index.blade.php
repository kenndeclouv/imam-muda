<x-app>
    <x-slot:css>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/jquery.dataTables.min.css">
    </x-slot:css>
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
        <div class="card app-calendar-wrapper mb-3 d-none d-lg-block">
            <div class="row w-100 g-0">
                <!-- Calendar Sidebar -->
                <div class="col-3 app-calendar-sidebar border-end pb-4" id="app-calendar-sidebar">
                    {{-- <div class="border-bottom p-6 my-sm-0 mb-4">
                        <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
                            <i class="fa fa-plus fa-16px me-2"></i>
                            <span class="align-middle">Add Event</span>
                        </button>
                    </div> --}}
                    <div class="px-3 pt-2">
                        <!-- inline calendar (flatpicker) -->
                        <div class="inline-calendar"></div>
                    </div>
                    <hr class="mb-6 mx-n4 mt-3">
                </div>
                <!-- /Calendar Sidebar -->

                <!-- Calendar & Modal -->
                <div class="col-9 app-calendar-content">
                    {{-- <div class="card shadow-none border-0">
                        <div class="card-body pb-0"> --}}
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                    {{-- </div>
                    </div> --}}
                    <div class="app-overlay"></div>
                </div>
                <!-- /Calendar & Modal -->
            </div>
        </div>

        <div class="card nav-align-top nav-tabs-shadow">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Jadwal</h5>
            </div>
            <ul class="nav nav-tabs nav-fill border-bottom" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#jadwal-imam" aria-controls="jadwal-imam" aria-selected="true"
                        tabindex="-1"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-home bx-sm me-1_5 align-text-bottom"></i>Jadwal Imam</span><i
                            class="bx bx-home bx-sm d-sm-none"></i></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#jadwal-badal" aria-controls="jadwal-badal" aria-selected="false"
                        tabindex="-1"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>Jadwal Badal</span><i
                            class="bx bx-user bx-sm d-sm-none"></i></button>
                </li>
            </ul>
            <div class="card-body pb-0">
                @include('components.alert')

                <div class="card-actions d-flex flex-wrap w-100">
                    <form method="GET" action="{{ route('imam.jadwal.index') }}" class="mb-3 w-100">
                        <label for="month" class="form-label">Pilih Bulan</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="month" id="month" name="month" class="form-control flex-grow-1"
                                value="{{ request('month') ?? now()->format('Y-m') }}" {{ request('month') ? 'selected' : '' }}>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('imam.jadwal.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                            <a href="{{ route('imam.jadwal.create') }}" class="btn btn-primary ms-auto mt-2 mt-sm-0">Tambah Jadwal</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="jadwal-imam">
                    <div class="card-datatable table-responsive text-start text-nowrap">
                        <table
                            class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100 dataTable"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Imam</th>
                                    <th>Shalat</th>
                                    <th>Nama Masjid</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->Imam->fullname }}</td>
                                        <td>{{ $jadwal->Shalat->name }}</td>
                                        <td>{{ $jadwal->Masjid->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->date)->format('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-2" aria-label="Basic example">
                                                @if ($jadwal->status == 'to_do')
                                                    @if ($jadwal->is_badal == 0)
                                                        <!-- Tombol Edit Jadwal -->
                                                        <a href="{{ route('imam.jadwal.edit', $jadwal->id) }}"
                                                            class="btn btn-warning" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit Jadwal">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </a>

                                                        <!-- Tombol Hapus Jadwal -->
                                                        <x-confirm-delete :route="route('imam.jadwal.destroy', $jadwal->id)" title="Hapus Jadwal"
                                                            message="Apakah anda yakin ingin menghapus jadwal ini?" />

                                                        <!-- Tombol Carikan Badal -->
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Carikan Badal">
                                                            <button type="button" class="btn btn-info"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#carikanBadalModal{{ $jadwal->id }}">
                                                                <i class="fa-solid fa-user-pen"></i>
                                                            </button>
                                                        </span>

                                                        <!-- Tombol Jadikan Selesai -->
                                                        <form id="done-form-{{ $jadwal->id }}"
                                                            action="{{ route('imam.jadwal.done', $jadwal->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Status Selesai"
                                                                onclick="confirmDone({{ $jadwal->id }})">
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        @if ($jadwal->badal_id != null)
                                                            <!-- Badge Dibadalkan -->
                                                            <div class="badge bg-label-warning">
                                                                Dibadalkan
                                                            </div>

                                                            <!-- Badge Nama Badal -->
                                                            <div class="badge bg-label-info">
                                                                {{ optional($jadwal->Badal)->fullname }}
                                                            </div>

                                                            @if ($jadwal->status == 'done')
                                                                <!-- Badge Telah Dilaksanakan -->
                                                                <div class="badge bg-label-success">
                                                                    Telah Dilaksanakan
                                                                </div>
                                                            @else
                                                                <!-- Badge Belum Dilaksanakan -->
                                                                <div class="badge bg-label-danger">
                                                                    Belum Dilaksanakan
                                                                </div>
                                                            @endif
                                                        @else
                                                            <!-- Badge Belum Dibadalkan -->
                                                            <div class="badge bg-label-danger">
                                                                Belum Dibadalkan
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <!-- Badge Telah Dilaksanakan -->
                                                    <div class="badge bg-label-success">
                                                        Telah Dilaksanakan
                                                    </div>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @foreach ($jadwals as $jadwal)
                    <!-- Modal -->
                    <div class="modal fade" id="carikanBadalModal{{ $jadwal->id }}" tabindex="-1"
                        aria-labelledby="carikanBadalModalLabel{{ $jadwal->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="carikanBadalModalLabel">Carikan Badal
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('imam.jadwal.cariBadal', $jadwal->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Catatan</label>
                                            <input type="text" class="form-control" id="note" name="note"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="tab-pane fade" id="jadwal-badal">
                    <div class="card-datatable table-responsive text-start text-nowrap">
                        <table
                            class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100 dataTable"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Imam Asli</th>
                                    <th>Tanggal</th>
                                    <th>Masjid</th>
                                    <th>Shalat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalBadals as $jadwalBadal)
                                    <tr>
                                        <td>{{ $jadwalBadal->Imam->fullname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwalBadal->date)->format('d F Y') }}</td>
                                        <td>{{ $jadwalBadal->Masjid->name }}</td>
                                        <td>{{ $jadwalBadal->Shalat->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2" aria-label="Basic example">
                                                @if ($jadwalBadal->status == 'to_do')
                                                    <form id="done-form-{{ $jadwalBadal->id }}"
                                                        action="{{ route('imam.jadwal.done', $jadwalBadal->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="button" class="btn btn-success"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Status Selesai"
                                                            onclick="confirmDone({{ $jadwalBadal->id }})">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form id="cancel-form-{{ $jadwalBadal->id }}"
                                                        action="{{ route('imam.jadwal.cancel', $jadwalBadal->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Batalkan Jadwal"
                                                            onclick="confirmCancel({{ $jadwalBadal->id }})">
                                                            <i class="fa-solid fa-x"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Badge Telah Dilaksanakan -->
                                                    <div class="badge bg-label-success">
                                                        Telah Dilaksanakan
                                                    </div>
                                                @endif

                                            </div>
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
    <x-slot:style>
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-calendar.css') }}">

        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/fullcalendar/fullcalendar.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        {{-- <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .modal {
                z-index: 1050;
                /* Default Bootstrap modal z-index */
            }

            .modal-backdrop {
                z-index: 1040;
                /* Background modal */
            }

            #calendar {
                margin-top: 30px;
            }

            .fc-toolbar-title {
                font-size: 1.5rem;
                font-weight: bold;
            }

            .fc-header-toolbar {
                padding: 0 20px;
            }

            .fc-list-event:hover {
                background-color: rgba(51, 51, 51, 0.13) !important;
            }

            .fc-daygrid-event {
                cursor: pointer;
                z-index: 1000 !important;
            }

            .fc-daygrid-day:hover {
                background-color: hsla(0, 0%, 0%, 0.079);
            }

            html[data-style="dark"],
            html[data-style="system"] {

                table,
                thead,
                tbody,
                tfoot,
                tr,
                td,
                th {
                    border-color: #4e4f6c !important;
                }

                .fc-col-header-cell {
                    border: none !important;
                    border-bottom: 1px solid #4e4f6c !important;
                }

                .fc-list {
                    border: none !important;
                }
            }

            html[data-style="light"] {

                table,
                thead,
                tbody,
                tfoot,
                tr,
                td,
                th {
                    border-color: #e4e6e8 !important;
                }

                .fc-col-header-cell {
                    border: none !important;
                    border-bottom: 1px solid #e4e6e8 !important;
                }
            }

            .fc-col-header-cell-cushion {
                padding: 8px 0 !important;
            }

            .fc-list-day>* {
                background: rgba(130, 130, 130, 0.5) !important;
                color: #fff !important;
            }

            .fc .fc-daygrid-event-dot {
                display: none !important;
            }
        </style>
    </x-slot:style>
    <x-slot:js>
        @include('components.show')
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
        <script>
            const htmlStyle = document.documentElement.getAttribute('data-style');
            const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
                '(prefers-color-scheme: dark)').matches);

            $(document).ready(function() {
                const calendarEl = $('#calendar')[0];

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    events: {
                        url: '/imam/jadwal/fetch',
                        failure: function() {
                            alert('There was an error fetching events!');
                        },
                    },
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false
                    },
                    timeZone: 'UTC',
                    selectable: false,
                    dayMaxEventRows: false,
                    dayMaxEvents: 3,
                    eventMaxStack: 3,
                    moreLinkClick: "popover",
                    themeSystem: 'bootstrap5',
                    dragScroll: false,
                    navLinks: true,
                    editable: false,
                    select: function(info) {
                        $('#eventDate').val(info.startStr);
                        new bootstrap.Offcanvas($('#addEventSidebar')[0]).show();
                        flatpickrInstance.setDate(info.startStr, true);
                    },
                    eventClick: function(info) {
                        show('Detail Jadwal', [{
                                label: 'Imam',
                                value: info.event.extendedProps.imam
                            },
                            {
                                label: 'Masjid',
                                value: info.event.extendedProps.masjid
                            },
                            {
                                label: 'Shalat',
                                value: info.event.extendedProps.shalat
                            }
                        ]);
                    },
                    eventDidMount: function(info) {
                        const shalatStyles = {
                            1: {
                                textColor: '#696cff',
                                bgColor: '#696cff29'
                            },
                            2: {
                                textColor: '#ff3e1d',
                                bgColor: '#ff3e1d29'
                            },
                            3: {
                                textColor: '#71dd37',
                                bgColor: '#71dd3729'
                            },
                            4: {
                                textColor: '#03c3ec',
                                bgColor: '#03c3ec29'
                            },
                            5: {
                                textColor: '#ffab00',
                                bgColor: '#ffab0029'
                            },
                            default: {
                                textColor: '#8592a3',
                                bgColor: '#8592a329'
                            }
                        };

                        const style = shalatStyles[info.event.extendedProps.shalat_id] || shalatStyles
                            .default;

                        $(info.el).css({
                            '--fc-event-text-color': style.textColor,
                            'background-color': style.bgColor,
                            'color': style.textColor,
                            'border': 'none',
                            'border-radius': '4px',
                            'padding': '4px',
                            'z-index': '100'
                        });
                    },
                    eventDataTransform: function(eventData) {
                        eventData.title =
                            `${eventData.extendedProps.shalat} - ${eventData.extendedProps.imam}`;
                        eventData.start = eventData.start || `${eventData.date}`;
                        return eventData;
                    },
                });


                calendar.render();

                var flatpickrInstance = $('.inline-calendar').flatpickr({
                    inline: true,
                    dateFormat: 'Y-m-d',
                    enableTime: false,
                    time_24hr: true,
                    defaultDate: new Date(),
                    UTC: true,
                    onReady: function(selectedDates, dateStr, instance) {
                        instance.jumpToDate(new Date());
                    },
                    onChange: function(selectedDates) {
                        if (selectedDates.length > 0) {
                            calendar.gotoDate(selectedDates[0]);
                        }
                    }
                });

                $('.dataTable').DataTable();

                // $('#jadwal-imam, #jadwal-shalat, #jadwal-masjid').select2({
                //     placeholder: "Pilih Opsi",
                //     dropdownParent: $('#addEventSidebar')
                // });

                // $('#filter_imam, #filter_shalat, #filter_masjid').select2({
                //     placeholder: "Pilih Filter",
                // });

            });

            function confirmDone(jadwalId) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, selesaikan!',
                    background: isDarkMode ? '#2b2c40' : '#fff',
                    color: isDarkMode ? '#b2b2c4' : '#000'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('done-form-' + jadwalId).submit();
                    }
                })
            }

            function confirmCancel(jadwalId) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, batalkan!',
                    background: isDarkMode ? '#2b2c40' : '#fff',
                    color: isDarkMode ? '#b2b2c4' : '#000'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cancel-form-' + jadwalId).submit();
                    }
                })
            }
        </script>
    </x-slot:js>
</x-app>
