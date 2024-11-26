<x-app>
    @php
        $permissions = Auth::user()->getPermissionCodes();
    @endphp
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
                    @if ($permissions->contains('jadwal_create'))
                        <div class="border-bottom p-6 my-sm-0 mb-4">
                            <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="offcanvas"
                                data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
                                <i class="fa fa-plus fa-16px me-2"></i>
                                <span class="align-middle">Add Event</span>
                            </button>
                        </div>
                    @endif
                    <div class="px-3 pt-2">
                        <div class="inline-calendar"></div>
                    </div>
                    <hr class="mb-6 mx-n4 mt-3">
                    <form class="px-3 pt-2" method="get">
                        <div class="mb-3">
                            <label for="filter-imam" class="form-label">Filter berdasarkan Imam</label>
                            <select id="filter_imam" class="form-control select2" name="filter_imam">
                                <option value="">Pilih Opsi</option>
                                @foreach ($imams as $imam)
                                    <option value="{{ $imam->id }}"
                                        {{ request('filter_imam') == $imam->id ? 'selected' : '' }}>
                                        {{ $imam->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filter-shalat" class="form-label">Filter berdasarkan Shalat</label>
                            <select id="filter_shalat" class="form-control select2" name="filter_shalat">
                                <option value="">Pilih Opsi</option>
                                @foreach ($shalats as $shalat)
                                    <option value="{{ $shalat->id }}"
                                        {{ request('filter_shalat') == $shalat->id ? 'selected' : '' }}>
                                        {{ $shalat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filter-masjid" class="form-label">Filter berdasarkan Masjid</label>
                            <select id="filter_masjid" class="form-control select2" name="filter_masjid">
                                <option value="">Pilih Opsi</option>
                                @foreach ($masjids as $masjid)
                                    <option value="{{ $masjid->id }}"
                                        {{ request('filter_masjid') == $masjid->id ? 'selected' : '' }}>
                                        {{ $masjid->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="apply-filters" class="btn btn-primary w-100">Filter</button>
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary w-100 mt-3">Reset</a>
                    </form>
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
                    <!-- FullCalendar Offcanvas -->
                    @if ($permissions->contains('jadwal_create'))
                        <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar"
                            aria-labelledby="addEventSidebarLabel">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Jadwal</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form class="event-form pt-0" id="eventForm" method="POST"
                                    action="{{ route('admin.jadwal.store') }}">
                                    @csrf
                                    <div class="mb-6">
                                        <label class="form-label" for="jadwal-imam">Nama Imam</label>
                                        <select name="imam_id" class="form-control select2" id="jadwal-imam" required>
                                            <option value="" disabled {{ old('imam_id') ? '' : 'selected' }}>
                                                Pilih
                                                Imam</option>
                                            @foreach ($imams as $imam)
                                                <option value="{{ $imam->id }}"
                                                    {{ old('imam_id') == $imam->id ? 'selected' : '' }}>
                                                    {{ $imam->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="jadwal-shalat">Shalat</label>
                                        <select name="shalat_id[]" class="form-control select2" id="jadwal-shalat"
                                            multiple required>
                                            @foreach ($shalats as $shalat)
                                                <option value="{{ $shalat->id }}"
                                                    {{ in_array($shalat->id, old('shalat_id', [])) ? 'selected' : '' }}>
                                                    {{ $shalat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="jadwal-masjid">Masjid</label>
                                        <select name="masjid_id" class="form-control select2" id="jadwal-masjid"
                                            required>
                                            <option value="" disabled {{ old('masjid_id') ? '' : 'selected' }}>
                                                Pilih
                                                Masjid</option>
                                            @foreach ($masjids as $masjid)
                                                <option value="{{ $masjid->id }}"
                                                    {{ old('masjid_id') == $masjid->id ? 'selected' : '' }}>
                                                    {{ $masjid->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="eventDate">Tanggal</label>
                                        <input type="date" class="form-control" id="eventDate" name="date"
                                            required />
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="jadwal-status">Status</label>
                                        <div id="jadwal-status">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status-to_do" value="to_do"
                                                    {{ old('status') == 'to_do' ? 'checked' : '' }} checked>
                                                <label class="form-check-label" for="status-to_do">
                                                    Akan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status-done" value="done"
                                                    {{ old('status') == 'done' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-done">
                                                    Selesai
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-sm-between justify-content-start mt-6 gap-2">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary me-4">Tambahkan</button>
                                            <button type="reset"
                                                class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                                data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>
                                        <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /Calendar & Modal -->
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Jadwal</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')

                <div class="card-actions d-flex flex-wrap w-100">
                    <form method="GET" action="{{ route('admin.jadwal.index') }}" class="mb-3 w-100">
                        <label for="month" class="form-label">Pilih Bulan</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="month" id="month" name="month" class="form-control flex-grow-1"
                                value="{{ request('month') ?? now()->format('Y-m') }}"
                                {{ request('month') ? 'selected' : '' }}>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                            @if ($permissions->contains('jadwal_create'))
                                <a href="{{ route('admin.jadwal.create') }}"
                                    class="btn btn-primary ms-auto mt-2 mt-sm-0">Tambah Jadwal</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="sorting_disabled dt-checkboxes-cell">
                                <input type="checkbox" class="form-check-input" id="checkbox-all">
                            </th>
                            <th>Tanggal</th>
                            <th>Nama Imam</th>
                            <th>Nama Masjid</th>
                            <th>Shalat</th>
                            <th>Status</th>
                            @if ($permissions->contains('jadwal_edit') || $permissions->contains('jadwal_delete'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="jadwal_id[]"
                                        value="{{ $jadwal->id }}" id="checkbox-{{ $jadwal->id }}">
                                </td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->date)->format('d F Y') }}</td>
                                <td>{{ $jadwal->Imam->fullname }}</td>
                                <td>{{ $jadwal->Masjid->name }}</td>
                                <td>{{ $jadwal->Shalat->name }}</td>
                                <td>
                                    @if ($jadwal->is_badal == 1 && $jadwal->badal_id == null)
                                        <span class="badge bg-label-danger">Membutuhkan Badal</span>
                                    @elseif($jadwal->is_badal == 1 && $jadwal->badal_id != null)
                                        <span class="badge bg-label-warning">Dibadalkan</span>
                                        <span
                                            class="badge bg-label-info">{{ optional($jadwal->Badal)->fullname }}</span>
                                    @endif
                                    @if ($jadwal->status == 'to_do')
                                        <span class="badge bg-label-danger">Belum dilaksanakan</span>
                                    @else
                                        <span class="badge bg-label-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($permissions->contains('jadwal_edit'))
                                        <div class="d-flex gap-2" aria-label="Basic example">
                                            <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                                                class="btn btn-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Edit Jadwal">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                    @endif
                                    @if ($permissions->contains('jadwal_delete'))
                                        <x-confirm-delete :route="route('admin.jadwal.destroy', $jadwal->id)" title="Hapus Jadwal"
                                            message="Apakah anda yakin ingin menghapus jadwal ini?" />
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        {{-- <script src="{{ asset('assets/vendor/js/admin-jadwal-index.js') }}" defer></script> --}}
        <script>
            $(document).ready(function() {
                function getUrlParams() {
                    const params = new URLSearchParams(window.location.search);
                    return {
                        filter_imam: params.get('filter_imam') || '',
                        filter_shalat: params.get('filter_shalat') || '',
                        filter_masjid: params.get('filter_masjid') || ''
                    };
                }
                const htmlStyle = document.documentElement.getAttribute('data-style');
                const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches);
                const calendarEl = $('#calendar')[0];

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    moreLinkClick: "popover",
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    timeZone: 'Asia/Jakarta',
                    events: {
                        url: '/admin/jadwal/fetch',
                        extraParams: getUrlParams,
                        failure: function() {
                            alert('There was an error fetching events!');
                        },
                    },
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false
                    },
                    selectable: true,
                    dayMaxEventRows: false,
                    dayMaxEvents: 3,
                    eventMaxStack: 3,
                    themeSystem: 'bootstrap5',
                    dragScroll: true,
                    navLinks: true,
                    editable: true,
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
                    eventDrop: updateEvent,
                    eventResize: updateEvent,
                });

                function updateEvent(info) {
                    const eventId = info.event.id;
                    const shalatId = info.event.extendedProps.shalat_id;
                    const masjidId = info.event.extendedProps.masjid_id;
                    const newStart = info.event.start.toISOString();
                    const newEnd = info.event.end ? info.event.end.toISOString() : null;

                    $.ajax({
                        url: '/admin/jadwal/updateJSON',
                        method: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: JSON.stringify({
                            id: eventId,
                            shalat_id: shalatId,
                            masjid_id: masjidId,
                            start: newStart,
                            end: newEnd,
                        }),
                        success: function(response) {
                            if (!response.success) {
                                info.revert(); // Error di backend
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan.',
                                    background: isDarkMode ? '#2b2c40' : '#fff',
                                    color: isDarkMode ? '#b2b2c4' : '#000',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Jadwal berhasil diperbarui.',
                                    background: isDarkMode ? '#2b2c40' : '#fff',
                                    color: isDarkMode ? '#b2b2c4' : '#000',
                                });
                            }
                        },
                        error: function(error) {
                            console.error(error);
                            info.revert();
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat memperbarui jadwal.',
                                background: isDarkMode ? '#2b2c40' : '#fff',
                                color: isDarkMode ? '#b2b2c4' : '#000',
                            });
                        }
                    });
                }

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

                $('#dataTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                    },
                    dom: '<"card-header flex-column justify-content-start flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-start pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [{
                            extend: "collection",
                            className: "btn btn-label-primary dropdown-toggle",
                            text: '<i class="fas fa-file-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [{
                                    extend: "print",
                                    text: '<i class="fas fa-print me-1" ></i>Print',
                                    className: "dropdown-item",
                                    title: "Jadwal Imam Bulan " + moment().format('MMMM YYYY'),
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        format: {
                                            body: function(data, row, column, node) {
                                                // jika kolom berisi tanggal
                                                if (moment(data, 'DD MMMM YYYY', true).isValid()) {
                                                    return moment(data).format(
                                                        'DD'); // hanya tampilkan tanggalnya
                                                }
                                                return data; // untuk kolom lain yang bukan tanggal
                                            }
                                        }
                                    },
                                },
                                {
                                    extend: "excelHtml5",
                                    text: '<i class="fas fa-file-excel me-1"></i>Excel',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5], // pilih kolom yang sesuai
                                        format: {
                                            body: function(data, row, column, node) {
                                                // Cek jika data adalah tanggal
                                                if (moment(data, 'DD MMMM YYYY', true).isValid()) {
                                                    return moment(data).format(
                                                        'DD'); // hanya tampilkan tanggalnya
                                                }

                                                // Cek jika data adalah HTML (misalnya status dengan <span>)
                                                if ($(data).is('span')) {
                                                    return $(data)
                                                        .text(); // Ambil teks tanpa HTML (misalnya "Belum dilaksanakan")
                                                }

                                                return data; // Jika bukan tanggal atau HTML, tampilkan data seperti biasa
                                            }
                                        }
                                    },
                                    title: "Jadwal Imam Bulan " + moment().format('MMMM YYYY'),
                                }
                            ],
                        },
                        {
                            text: '<i class="fas fa-trash me-sm-2"></i> <span class="d-none d-sm-inline-block">Delete All</span>',
                            className: "btn btn-danger ms-3",
                            action: function(e, dt, node, config) {
                                // kumpulkan id checkbox yang dicentang
                                let selectedIds = [];
                                $('input[name="jadwal_id[]"]:checked').each(function() {
                                    selectedIds.push($(this).val());
                                });

                                // jika tidak ada checkbox yang dicentang
                                if (selectedIds.length === 0) {
                                    Swal.fire({
                                        title: "Tidak Ada Data Terpilih",
                                        text: "Silakan pilih data yang ingin dihapus terlebih dahulu!",
                                        icon: "error",
                                        confirmButtonColor: 'var(--bs-primary)',
                                        background: isDarkMode ? '#2b2c40' : '#fff',
                                        color: isDarkMode ? '#b2b2c4' : '#000',
                                    });
                                    return;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hapus Jadwal',
                                    text: 'Apakah Anda yakin ingin menghapus jadwal terpilih?',
                                    showCancelButton: true,
                                    confirmButtonText: 'Hapus',
                                    confirmButtonColor: '#d33',
                                    cancelButtonText: 'Batal',
                                    background: isDarkMode ? '#2b2c40' : '#fff',
                                    color: isDarkMode ? '#b2b2c4' : '#000',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let form = document.createElement('form');
                                        form.action =
                                        '/admin/jadwal/delete-selected'; // ganti dengan route hapus kamu
                                        form.method = 'POST';

                                        // tambahkan csrf token
                                        let csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = '{{ csrf_token() }}';
                                        form.appendChild(csrfInput);

                                        // tambahkan method DELETE
                                        let methodInput = document.createElement('input');
                                        methodInput.type = 'hidden';
                                        methodInput.name = '_method';
                                        methodInput.value = 'DELETE';
                                        form.appendChild(methodInput);

                                        // tambahkan id checkbox ke form
                                        selectedIds.forEach(function(id) {
                                            let idInput = document.createElement(
                                                'input');
                                            idInput.type = 'hidden';
                                            idInput.name = 'jadwal_id[]';
                                            idInput.value = id;
                                            form.appendChild(idInput);
                                        });

                                        document.body.appendChild(form);
                                        form.submit();
                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                        Swal.fire({
                                            title: "Batal",
                                            text: "Anda tidak jadi menghapus data ini :)",
                                            icon: "error",
                                            background: isDarkMode ? '#2b2c40' : '#fff',
                                            color: isDarkMode ? '#b2b2c4' : '#000',
                                            confirmButtonColor: 'var(--bs-primary)',
                                        });
                                    }
                                });
                            }
                        }

                    ],
                });

                $('#jadwal-imam, #jadwal-shalat, #jadwal-masjid').select2({
                    placeholder: "Pilih Opsi",
                    dropdownParent: $('#addEventSidebar')
                });

                $('#filter_imam, #filter_shalat, #filter_masjid').select2({
                    placeholder: "Pilih Filter",
                });

                $('#checkbox-all').click(function() {
                    $('input[type="checkbox"]').prop('checked', this.checked);
                });
            });
        </script>
    </x-slot:js>
</x-app>
