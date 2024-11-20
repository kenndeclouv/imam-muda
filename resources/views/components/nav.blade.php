@php
    $user = Auth::user();
@endphp
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="fa-solid fa-grid-2"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="sk-fold sk-primary d-none d-lg-block m-2">
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-eclipse fa-xl"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span><i class="fa-solid fa-sun me-3"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span><i class="fa-solid fa-moon me-3"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span><i class="fa-solid fa-desktop me-3"></i>System</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- Quick links  -->
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Shortcuts">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="fa-solid fa-grid-2 fa-xl"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Shortcuts</h6>
                            <a href="javascript:void(0)" class="dropdown-shortcuts-add py-2" data-bs-toggle="modal"
                                data-bs-target="#addShortcutModal" title="Add shortcuts"><i
                                    class="fa-solid fa-plus-circle fa-xl text-heading"></i></a>
                        </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                        <div class="row row-bordered overflow-visible g-0">
                            @foreach ($user->UserShortcuts as $shortcut)
                                <div class="dropdown-shortcuts-item col-6">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                        <i class="{{ $shortcut->icon ?? 'fa-solid fa-bookmark' }} text-heading"></i>
                                    </span>
                                    <a href="{{ $shortcut->link }}" class="stretched-link">{{ $shortcut->title }}</a>
                                    <small>{{ $shortcut->description }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
            <!-- Quick links -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Notifikasi">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                        <i class="fa-solid fa-bell fa-xl"></i>
                        @if ($user->UserNotifications->where('is_displayed', 0)->count() > 0)
                            <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Notification</h6>
                            <div class="d-flex align-items-center h6 mb-0">
                                @if ($user->UserNotifications->where('is_displayed', 0)->count() > 0)
                                    <span
                                        class="badge bg-label-primary me-2">{{ $user->UserNotifications->where('is_displayed', 0)->count() }}
                                        New</span>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @foreach ($user->UserNotifications->where('is_displayed', 0) as $notif)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <a href="{{ $notif->link }}" class="w-100"
                                        onclick="markNotificationAsRead({{ $notif->id }})">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="small mb-0">
                                                    {{ $notif->title }}
                                                </h6>
                                                <small class="mb-1 d-block text-body">{{ $notif->content }}</small>
                                                <small
                                                    class="text-muted">{{ $notif->created_at->diffForHumans(null, true) }}
                                                    ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                                    onclick="markNotificationAsRead({{ $notif->id }})">
                                                    <span class="fa-solid fa-times-circle"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown"
                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Akun">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if ($user->photo)
                            <img src="{{ $user->photo }}" alt="" class="w-px-40 h-auto rounded-circle" />
                        @else
                            <img src="/assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('account') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if ($user->photo)
                                            <img src="{{ $user->photo }}" alt=""
                                                class="w-px-40 h-auto rounded-circle" />
                                        @else
                                            <img src="/assets/img/avatars/1.png" alt=""
                                                class="w-px-40 h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ strtoupper($user->name ?? '-') }}</h6>
                                    <small class="text-muted">{{ $user->Role->name ?? '-' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('account') }}">
                            <i class="fa-solid fa-address-card fa-lg me-3"></i><span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void()" onclick="showLogoutConfirm();">
                            <i class="fa-solid fa-sign-out-alt fa-lg me-3"></i><span>Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="addShortcutModal" tabindex="-1" aria-labelledby="addShortcutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addShortcutModalLabel">Add Shortcut</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addShortcutForm" action="{{ route('account.shortcut') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="shortcutTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="shortcutTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="shortcutLink" class="form-label">Link</label>
                        <select class="form-control select2" id="shortcutLink" name="link">
                            <option value="">Pilih Url</option>
                            @foreach ($user->getAccessibleRoutes() as $route)
                                @php
                                    // Tentukan apakah route termasuk dalam opsi
                                    $isIncluded =
                                        (str_ends_with($route['name'], '.index') ||
                                            str_ends_with($route['name'], '.create') ||
                                            str_ends_with($route['name'], '.home') ||
                                            $route['name'] == 'account') &&
                                        $route['name'] != 'login.index';

                                    // Format nama route
                                    $routeName = $route['name'];
                                    $formattedRoute = str_replace('admin', '', $routeName);
                                    $formattedRoute = str_replace('.', ' ', $formattedRoute);
                                    $formattedRoute = str_replace('create', 'tambah data', $formattedRoute);
                                    $formattedRoute = str_replace('index', 'data', $formattedRoute);
                                    $formattedRoute = ucwords($formattedRoute);
                                @endphp

                                @if ($isIncluded)
                                    <option value="/{{ e($route['uri']) }}">{{ e($formattedRoute) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shortcutIcon" class="form-label">Icon</label>
                        <select class="form-control" id="icon" name="icon">
                            <option value="">Pilih Icon</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shortcutDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="shortcutDescription" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Shortcut</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script>
    $('#shortcutLink').select2({
        placeholder: 'Pilih Url',
        dropdownParent: $('#addShortcutModal')
    });

    function showLogoutConfirm() {
        // const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const htmlStyle = document.documentElement.getAttribute('data-style');
        const isDarkMode = htmlStyle === 'dark' || (htmlStyle !== 'light' && window.matchMedia(
            '(prefers-color-scheme: dark)').matches);
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah anda yakin ingin logout dari akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Tidak',
            confirmButtonColor: 'var(--bs-primary)',
            cancelButtonColor: '#8592a3',
            background: isDarkMode ? '#2b2c40' : '#fff',
            color: isDarkMode ? '#b2b2c4' : '#000',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    $(document).ready(function() {

        fetch('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.6.0/metadata/icons.json')
            .then(response => response.json())
            .then(data => {
                const $select = $('#icon');
                Object.keys(data).forEach(icon => {
                    const styles = data[icon].styles;

                    styles.forEach(style => {
                        let prefix = 'fa';
                        if (style === 'brands') {
                            prefix = 'fab';
                        } else if (style === 'regular') {
                            prefix = 'far';
                        } else if (style === 'solid') {
                            prefix = 'fas';
                        } else if (style === 'light') {
                            prefix = 'fal';
                        } else if (style === 'duotone') {
                            prefix = 'fad';
                        } else if (style === 'thin') {
                            prefix = 'fat';
                        }
                        const iconClass = `${prefix} fa-${icon}`;
                        const displayName = icon.replace(/-/g, ' ');
                        $select.append(
                            `<option data-icon="${iconClass}" value="${iconClass}">${displayName}</option>`
                        );
                    });
                });

                $select.select2({
                    dropdownParent: $('#addShortcutModal'), // Dropdown akan berada di dalam modal
                    templateResult: function(option) {
                        if (!option.id) return option.text;
                        return $(
                            `<span><i class="${$(option.element).data('icon')}"></i> ${option.text}</span>`
                        );
                    },
                    templateSelection: function(option) {
                        if (!option.id) return option.text;
                        return $(
                            `<span><i class="${$(option.element).data('icon')}"></i> ${option.text}</span>`
                        );
                    }
                });
            });

    });

    function fetchNotifications() {
        $.ajax({
            url: '/api/get-notifications',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(notifications) {
                const unreadNotifications = notifications.filter(notification => !notification
                    .is_display);

                unreadNotifications.forEach(notification => {
                    showToast(
                        notification.id,
                        notification.title,
                        notification.content,
                        notification.link,
                        notification.created_at
                    );
                });
            },
            error: function(error) {
                console.error('Failed to fetch notifications:', error);
            }
        });
    }

    function showToast(notificationId, title, content, link, created_at) {
        const timeAgo = moment(created_at).fromNow();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onShown": function() {
                const toast = document.querySelector('.toast');
                const closeButton = toast.querySelector('.toast-close-button');
                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        markNotificationAsRead(notificationId);
                    });
                }
            },
            "onclick": function() {
                window.location.href = link;
                markNotificationAsRead(notificationId);
            },
        };

        toastr.info(content, title + ' <small>(' + timeAgo + ')</small>');
    }

    function markNotificationAsRead(notificationId) {
        fetch('/api/mark-notification-as-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    notification_id: notificationId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Notification marked as read');
                }
            })
            .catch(error => console.error('Error marking notification as read:', error));
    }

    $(document).ready(function() {
        fetchNotifications();

    });
</script>
