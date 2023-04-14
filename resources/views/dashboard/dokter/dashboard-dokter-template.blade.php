@section('title', 'Dashboard Dokter')

@extends('app')

@section('header')
    <!-- Vendor CSS Files -->
    <link href="assets_NADM/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_NADM/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_NADM/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_NADM/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets_NADM/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets_NADM/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_NADM/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets_NADM/css/style.css" rel="stylesheet">
@endsection

@section('content')

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('beranda') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('favicon.ico') }}" alt="">
                <span class="d-none d-lg-block">TelkomSehat</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown" href="">
                        <img src="assets_NADM/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $dokter->username }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->name }}</h6>
                            <span>{{ $dokter->kodedokter }}</span>
                            <br>
                            <span>{{ $dokter->spesialis }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout.action') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!-- ======= End Header ======= -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                @if ($title == 'Dashboard Dokter')
                    <a class="nav-link " href="{{ route('dashboard-dokter') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-dokter') }}">
                @endif
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                @if ($title == 'Dashboard Reservasi')
                    <a class="nav-link" href="{{ route('dashboard-dokter-reservasi') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-dokter-reservasi') }}">
                @endif
                <i class="bi bi-menu-button-wide"></i>
                <span>Reservasi</span>
                </a>
            </li>

            <li class="nav-item">
                @if ($title == 'Dashboard Konsultasi')
                    <a class="nav-link" href="{{ route('dashboard-dokter-konsultasi') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-dokter-konsultasi') }}">
                @endif
                <i class="bi bi-chat-square-text"></i>
                <span>Konsultasi</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- ======= End Sidebar ======= -->

    <!-- ======= Main ======= -->
    <main id="main" class="main">
        @yield('contentx')
    </main>
    <!-- ======= End Main ======= -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>TelkomSehat</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="{{ url()->current() }}">YoNdakTauKokTanyaSaya</a>
        </div>
    </footer>
    <!-- ======= End Footer ======= -->

    <!-- ======= Arrow Up Button ======= -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- ======= End Arrow Up Button ======= -->

@endsection

@section('bottomScript')
    <!-- Vendor JS -->
    <script src="assets_NADM/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets_NADM/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_NADM/vendor/chart.js/chart.umd.js"></script>
    <script src="assets_NADM/vendor/echarts/echarts.min.js"></script>
    <script src="assets_NADM/vendor/quill/quill.min.js"></script>
    <script src="assets_NADM/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets_NADM/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets_NADM/vendor/php-email-form/validate.js"></script>

    <!-- Main JS -->
    <script src="assets_NADM/js/main.js"></script>
@endsection