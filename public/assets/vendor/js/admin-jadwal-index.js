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
        timeZone: 'UTC',
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
        // dom: 'Bfrtip',
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
                            form.action = '/admin/jadwal/delete-selected'; // ganti dengan route hapus kamu
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
