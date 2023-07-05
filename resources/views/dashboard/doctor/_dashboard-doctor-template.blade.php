@section('title', 'Dashboard Dokter')

@extends('_app')

@section('header')
    <!-- Vendor CSS Files -->
    <!-- Vendor CSS Files -->
    {{-- <link href="assets_NADM/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.snow.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.bubble.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/remixicon/remixicon.css" rel="stylesheet"> --}}
    <link href="assets_NADM/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet"
        integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css" rel="stylesheet"
        integrity="sha512-XMxqcAfuPHOh2Kz0Z3oDynUcLgyKP6B1NCKUTxyVbM02u1ZrygDcLddKw7KpN/SGmdw8raHbKgaIHP7+bEfGYw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.bubble.css" rel="stylesheet"
        integrity="sha512-mLecVYo2QWbbYIF2u/ppRT91u615n044kBhrGzqbKQRRQxBUj8BR5b+z9qQsUNyWVYr8Z+c/TISuI7cnbpqpWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.3.0/remixicon.css" rel="stylesheet"
        integrity="sha512-0JEaZ1BDR+FsrPtq5Ap9o05MUwn8lKs2GiCcRVdOH0qDcUcCoMKi8fDVJ9gnG8VN1Mp/vuWw2sMO0SQom5th4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS File -->
    <link href="assets_NADM/css/style.css" rel="stylesheet">
@endsection

@section('content')

    <!-- ======= Header ======= -->
    <header class="header fixed-top d-flex align-items-center" id="header">
        <div class="d-flex align-items-center justify-content-between">
            {{-- <i class="bi bi-list toggle-sidebar-btn pe-2 me-3 border border-3 border-primary-subtle rounded"></i> --}}
            <a class="logo d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('favicon.ico') }}" alt="">
                <span class="d-none d-lg-block">TelkomSehat</span>
            </a>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown" href="">
                        <img class="rounded-circle" src="assets_NADM/img/profile-img.jpg" alt="Profile">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $doctor->username }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->name }}</h6>
                            <span>{{ $doctor->doctor_code }}</span>
                            <br>
                            {{-- <span>{{ '@' . $doctor->username }}</span> --}}
                            {{-- <br> --}}
                            <span>{{ $doctor->spesialis }}</span>
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
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                @if ($title == 'Dashboard Dokter')
                    <a class="nav-link " href="{{ route('dashboard-doctor') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-doctor') }}">
                @endif
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                @if ($title == 'Dashboard Reservasi')
                    <a class="nav-link" href="{{ route('dashboard-doctor-reservation') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-doctor-reservation') }}">
                @endif
                <i class="bi bi-menu-button-wide"></i>
                <span>Reservasi</span>
                </a>
            </li>

            <li class="nav-item">
                @if ($title == 'Dashboard Konsultasi')
                    <a class="nav-link" href="{{ route('dashboard-doctor-consultation') }}">
                    @else
                        <a class="nav-link collapsed" href="{{ route('dashboard-doctor-consultation') }}">
                @endif
                <i class="bi bi-chat-square-text"></i>
                <span>Konsultasi</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- ======= End Sidebar ======= -->

    <!-- ======= Main ======= -->
    <main class="main" id="main">
        @yield('contentx')
    </main>
    <!-- ======= End Main ======= -->

    <!-- ======= Footer ======= -->
    <footer class="footer" id="footer">
        <div class="copyright">
            Copyright &copy; 2023 <strong><span>TelkomSehat</span></strong> — All Rights Reserved
        </div>
        <div class="credits">
            {{-- Designed by <a href="{{ url()->current() }}">YoNdakTauKokTanyaSaya</a> --}}
            Designed by
            <a href="https://github.com/ramhaidar/TelkomSehat_Laravel_10.6.2/graphs/contributors">
                SriPandita Team&trade;
            </a>
        </div>
    </footer>
    <!-- ======= End Footer ======= -->

    <!-- ======= Arrow Up Button ======= -->
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- ======= End Arrow Up Button ======= -->

@endsection

@section('bottomScript')
    <!-- Vendor JS -->
    {{-- <script src="assets_NADM/vendor/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="assets_NADM/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="assets_NADM/vendor/chart.js/chart.umd.js"></script> --}}
    {{-- <script src="assets_NADM/vendor/echarts/echarts.min.js"></script> --}}
    {{-- <script src="assets_NADM/vendor/quill/quill.min.js"></script> --}}
    <script src="assets_NADM/vendor/simple-datatables/simple-datatables.js"></script>
    {{-- <script src="assets_NADM/vendor/tinymce/tinymce.min.js"></script> --}}
    <script src="assets_NADM/vendor/php-email-form/validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.40.0/apexcharts.min.js"
        integrity="sha512-Kr1p/vGF2i84dZQTkoYZ2do8xHRaiqIa7ysnDugwoOcG0SbIx98erNekP/qms/hBDiBxj336//77d0dv53Jmew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"
        integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"
        integrity="sha512-CMF3tQtjOoOJoOKlsS7/2loJlkyctwzSoDK/S40iAB+MqWSaf50uObGQSk5Ny/gfRhRCjNLvoxuCvdnERU4WGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.2/echarts.min.js"
        integrity="sha512-VdqgeoWrVJcsDXFlQEKqE5MyhaIgB9yXUVaiUa8DR2J4Lr1uWcFm+ZH/YnzV5WqgKf4GPyHQ64vVLgzqGIchyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"
        integrity="sha512-P2W2rr8ikUPfa31PLBo5bcBQrsa+TNj8jiKadtaIrHQGMo6hQM6RdPjQYxlNguwHz8AwSQ28VkBK6kHBLgd/8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.2/tinymce.min.js"
        integrity="sha512-sWydClczl0KPyMWlARx1JaxJo2upoMYb9oh5IHwudGfICJ/8qaCyqhNTP5aa9Xx0aCRBwh71eZchgz0a4unoyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS -->
    <script src="assets_NADM/js/main.js"></script>
@endsection
