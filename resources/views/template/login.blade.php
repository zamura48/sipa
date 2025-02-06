<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPA') }} || {{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="<?= asset('assets/lib/sb_admin') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= asset('assets/lib/sb_admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= asset('assets/css') ?>/custom.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            @yield('content')

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= asset('assets/lib/sb_admin') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= asset('assets/lib/sb_admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= asset('assets/lib/sb_admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= asset('assets/lib/sb_admin') ?>/js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('js')

    <script src="<?= asset('assets/js') ?>/configuration.js"></script>
    @include('template.partials.flash_message')

</body>

</html>
