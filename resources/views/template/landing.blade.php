<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPA') }}</title>

    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= asset('assets/lib/ilanding') ?>/assets/css/main.css" rel="stylesheet">
    <link href="<?= asset('assets/css') ?>/custom.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    @include('template.partials.landing.header')

    @yield('content')

    @include('template.partials.landing.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>

    <!-- Main JS File -->
    <script src="<?= asset('assets/lib/ilanding') ?>/assets/js/main.js"></script>
    <script src="<?= asset('assets/js') ?>/configuration.js"></script>

    @yield('js')

</body>

</html>
