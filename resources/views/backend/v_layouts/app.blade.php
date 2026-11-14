<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - EduRelawan</title>

    <link rel="icon" type="image/png" href="{{ asset('spark-admin/assets/images/favicon.ico') }}">

    {{-- CSS Spark Admin --}}
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/apexcharts/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/css/main.css') }}">
</head>

<body>

    @include('backend.components.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="main-wrapper">
        @include('backend.components.navbar')

        {{-- HEADER HALAMAN --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    @yield('judul_halaman', 'Dashboard')
                </h1>
                <p class="page-subtitle">
                    @yield('deskripsi_halaman', 'Selamat datang di EduRelawan.')
                </p>
            </div>
        </div>

        {{-- KONTEN HALAMAN --}}
        <div class="container-fluid px-0">
            @yield('content')
        </div>

        {{-- FOOTER --}}
        <footer class="footer-custom">
            <div class="footer-left">
                <span class="footer-logo">
                    <i class="bi bi-asterisk"></i>
                    EduRelawan
                </span>
                <span class="footer-separator">|</span>
                <span class="footer-copy">
                    &copy; {{ date('Y') }} EduRelawan
                </span>
            </div>
            <div class="footer-right">
                <span class="footer-link">
                    Platform Pendidikan dan Relawan
                </span>
            </div>
        </footer>
    </div>

    <script src="{{ asset('spark-admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('spark-admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('spark-admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('spark-admin/assets/js/dashboard.js') }}"></script>

    @stack('scripts')

</body>

</html>
