<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>{{ $title ?? 'Selamat Datang' }} | {{ ucwords(str_replace('_', ' ', config('app.name'))) }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/192.png') }}">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js")
                .then((reg) => console.log("Service Worker registered!", reg))
                .catch((err) => console.log("Service Worker failed!", err));
        }
    </script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <!-- Page CSS -->
    @if (isset($css))
        {{ $css }}
    @endif

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    {{ $slot }}

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @if (isset($js))
        {{ $js }}
    @endif
    <script>
        let deferredPrompt;

        window.addEventListener("beforeinstallprompt", (event) => {
            event.preventDefault();
            deferredPrompt = event;

            const installBtn = document.createElement("button");
            installBtn.textContent = "Install Imam Muda";
            installBtn.classList.add("btn", "btn-primary", "position-fixed", "bottom-0", "end-0", "m-3");
            installBtn.style.zIndex = "1000";

            document.body.appendChild(installBtn);

            installBtn.addEventListener("click", () => {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === "accepted") {
                        console.log("User accepted the install prompt");
                    }
                    installBtn.remove();
                });
            });
        });
    </script>
</body>

</html>
