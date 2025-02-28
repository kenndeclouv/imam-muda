self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open("imam-muda-cache").then((cache) => {
            return cache.addAll(
                [
                    "/login",
                    "/assets/css/demo.css",
                    "/assets/js/app.js",
                    "/assets/img/favicon/192.png",
                    "/assets/img/favicon/512.png",
                    "/assets/vendor/css/rtl/core.css",
                    "/assets/vendor/css/rtl/theme-default.css",
                    "/assets/vendor/libs/select2/select2.css",
                    "/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css",
                    "/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css",
                    "/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css",
                    "/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css",
                    "/assets/vendor/libs/spinner/spinner.css",
                    "/assets/vendor/libs/toastr/toastr.css",
                    "/assets/vendor/libs/apex-charts/apex-charts.css",
                    "/assets/vendor/libs/flatpickr/flatpickr.css",
                    "/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",
                    "/assets/js/main.js",
                ].map((url) => new Request(url, { cache: "reload" }))
            );
        })
    );
});

self.addEventListener("fetch", (event) => {
    if (event.request.url.includes("/login")) {
        // Bypass cache untuk halaman login
        event.respondWith(fetch(event.request));
    } else {
        event.respondWith(
            caches.match(event.request).then((response) => {
                return response || fetch(event.request);
            })
        );
    }
});