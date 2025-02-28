<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="front-pages" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>{{ $title }} | {{ config('app.name') }}</title>


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/192.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="{{ asset('css2-1?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap') }}"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons-1.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core-1.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default-1.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/css/demo-1.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}">
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider-1.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper-1.css') }}">

    <!-- Page CSS -->
    @if (request()->is('frontpage-checkout'))
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2-1.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper-1.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/rateyo/rateyo-1.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/form-validation-1.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/wizard-ex-checkout-1.css')}}">
    @endif

    @if (request()->is('frontpage-payment'))
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-payment.css') }}">
    @endif

    @if (request()->is('frontpage-pricing'))
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-pricing.css') }}">
    @endif

    @if (request()->is('frontpage-help'))
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-help-center.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers-1.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer-1.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/front-config.js') }}"></script>

</head>

<body>
    <script src="{{ asset('assets/vendor/js/dropdown-hover-1.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown-1.js') }}"></script>
    {{ $slot }}
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/popper/popper-1.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap-1.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider-1.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper-1.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/front-main.js') }}"></script>


    <!-- Page JS -->
    @if (isset($js))
        {{ $js }}
    @endif

</body>

</html>
