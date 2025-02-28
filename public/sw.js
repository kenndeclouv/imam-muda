self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open("imam-muda-cache").then((cache) => {
            return cache.addAll([
                "/",
                "/assets/css/demo.css",
                "/assets/js/app.js",
                "/images/icons/icon-192x192.png",
                "/images/icons/icon-512x512.png",
                "https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap",
                "https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css",
                "/assets/vendor/css/rtl/core.css",
                "/assets/vendor/css/rtl/theme-default.css",
                "/assets/css/demo.css",
                "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css",
                "/assets/vendor/libs/select2/select2.css",
                "/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css",
                "/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css",
                "/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css",
                "/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css",
                "/assets/vendor/libs/spinner/spinner.css",
                "/assets/vendor/libs/toastr/toastr.css",
                "/assets/vendor/libs/apex-charts/apex-charts.css",
                "https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5@2.2.3/css/buttons.bootstrap5.min.css",
                "/assets/vendor/libs/flatpickr/flatpickr.css",
                "https://cdn.jsdelivr.net/npm/@form-validation@1.8.1/dist/css/formValidation.min.css",
                "/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",

                "/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css",
                "/assets/vendor/libs/flatpickr/flatpickr.css",
                "/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",
                "/assets/js/main.js",
            ]);
        })
    );
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});
