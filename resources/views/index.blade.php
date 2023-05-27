@section('title', 'Beranda')

@extends('app')

@section('style')
    <style>
        #nodecoration {
            text-decoration: none;
        }
    </style>
@endsection

@section('header')
    <!-- Vendor CSS Files -->
    <link href="assets_MDLB/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_MDLB/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets_MDLB/css/style.css" rel="stylesheet">

    <!-- JQuery 3.6.0 File -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top shadow">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto">
                <a href="{{ route('beranda') }}" class="logo d-flex align-items-center w-auto" id="nodecoration">
                    <img src="{{ asset('favicon.ico') }}" alt="">
                    <span class="d-none ms-3 d-lg-block">TelkomSehat</span>
                </a>
            </h1>

            <nav id="navbar" class="navbar order-last order-lg-0" style="padding-right: 25px;">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                </ul>
                <i class="fas fa-list mobile-nav-toggle"></i>
            </nav>

            @auth
                <a class="btn btn-danger appointment-btn-red float-end" href="{{ route('logout.action') }}"
                    role="button">Sign-Out</a>
                @if ($users->pasien_id)
                    <a class="btn btn-primary appointment-btn float-end" href="{{ route('dashboard-pasien') }}"
                        role="button">Dashboard</a>
                @elseif ($users->dokter_id)
                    <a class="btn btn-primary appointment-btn float-end" href="{{ route('dashboard-dokter') }}"
                        role="button">Dashboard</a>
                @elseif ($users->paramedis_id)
                    <a class="btn btn-primary appointment-btn float-end" href="{{ route('dashboard-paramedis') }}"
                        role="button">Dashboard</a>
                @endif
            @endauth

            @guest
                <div class="me-3" style="border-left: 1px solid black; height: 40px;"></div>
                <a class="btn btn-secondary btn-sm float-end mx-2 px-4"
                    style="width: 10%; height: 40px; display: flex; justify-content: center; align-items: center; font-family: 'Open Sans', sans-serif;"
                    href="{{ route('registrasi-pasien') }}" role="button">
                    <h6 style="margin: 0;">Registrasi</h6>
                </a>
                <a class="btn btn-primary btn-sm float-end mx-2 px-4"
                    style="width: 10%; height: 40px; display: flex; justify-content: center; align-items: center; font-family: 'Open Sans', sans-serif;"
                    href="{{ route('login') }}" role="button">
                    <h6 style="margin: 0;">Login</h6>
                </a>
            @endguest
        </div>
    </header>
    <!-- ======= End Header ======= -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to TelkomSehat</h1>
            <h2>Sehatkan Hidupmu dengan TelkomSehat, Solusi Kesehatan Digitalmu!</h2>
        </div>
    </section>
    <!-- ======= End Hero Section ======= -->

    <!-- ======= Main Section ======= -->
    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Kenapa Memilih TelkomSehat?</h3>
                            <p style="text-align: justify">
                                Telkom Sehat adalah layanan kesehatan online yang disediakan oleh Telkom Indonesia.
                                Layanan ini memudahkan masyarakat Indonesia untuk konsultasi kesehatan secara online,
                                memesan obat yang diantar ke rumah, serta menyediakan informasi kesehatan terkini untuk
                                memberi informasi kesehatan pengguna.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">

                                <div class="row">
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="fas fa-calendar-alt"></i>
                                            <h4>Reservasi Jadwal</h4>
                                            <p>TelkomSehat menyediakan layanan reservasi jadwal untuk konsultasi dengan
                                                dokter
                                                yang diinginkan. Pasien dapat memilih jadwal yang tersedia sesuai dengan
                                                kebutuhan dan ketersediaan dokter.</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="fas fa-user-md"></i>
                                            <h4>Konsultasi Dokter</h4>
                                            <p>TelkomSehat menyediakan layanan konsultasi dokter secara online untuk
                                                memudahkan
                                                pasien dalam mendapatkan
                                                penanganan medis. Pasien dapat berkonsultasi dengan dokter spesialis yang
                                                tersedia di TelkomSehat.</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="fas fa-ambulance"></i>
                                            <h4>Penjemputan Darurat</h4>
                                            <p>TelkomSehat menyediakan layanan penjemputan darurat bagi pasien yang
                                                membutuhkan
                                                perawatan medis segera dan tidak dapat mencapai fasilitas kesehatan sendiri.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Layanan Section ======= -->
        <section id="services" class="services">
            <div class="container">
                <div class="section-title">
                    <h2>Layanan</h2>
                    <p>TelkomSehat adalah layanan kesehatan online yang disediakan oleh Telkom Indonesia. Layanan ini
                        bertujuan untuk memberikan akses mudah dan cepat bagi masyarakat Indonesia untuk melakukan reservasi
                        dokter dan konsultasi kesehatan secara online. Berikut adalah layanan yang dapat Anda dapatkan dari
                        TelkomSehat
                    </p>
                </div>

                <div class="row">

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-stethoscope"></i></div>
                            <h4><a>Konsultasi dengan Dokter Spesialis</a></h4>
                            <p>Dokter-dokter kami merupakan ahli di bidangnya dan senantiasa bersiap memberikan layanan
                                terbaik bagi pasien.
                                Anda dapat melakukan konsultasi dengan dokter spesialis yang paling tepat untuk kebutuhan
                                Anda.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4><a>Peralatan Medis Terbaru dan Modern</a></h4>
                            <p>Klinik kami dilengkapi dengan peralatan medis terbaru dan modern, sehingga pasien dapat
                                merasa nyaman dan aman selama berada di klinik.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-calendar-check"></i></div>
                            <h4><a>Sistem Reservasi Online</a></h4>
                            <p>Kami memiliki sistem reservasi online yang memudahkan pasien untuk membuat janji dengan
                                dokter tanpa harus datang ke klinik terlebih dahulu.
                                Anda dapat memilih dokter spesialis yang sesuai dengan kebutuhan Anda dan membuat janji
                                dengan mudah melalui sistem pendaftaran online kami.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4><a>Pelayanan Ramah dan Profesional</a></h4>
                            <p>Kami memberikan pelayanan yang ramah dan profesional kepada setiap pasien yang datang ke
                                klinik kami.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-clock"></i></div>
                            <h4><a>Jadwal Fleksibel</a></h4>
                            <p>Klinik kami memiliki jadwal yang fleksibel, sehingga pasien dapat memilih waktu yang sesuai
                                dengan jadwal mereka untuk berkunjung ke klinik kami.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-hospital"></i></div>
                            <h4><a>Komitmen Pelayanan Kesehatan Terbaik</a></h4>
                            <p>Klinik TelkomSehat berkomitmen untuk memberikan pelayanan kesehatan terbaik bagi setiap
                                pasien. Dokter-dokter yang ahli di bidangnya selalu siap memberikan pelayanan terbaik untuk
                                pasien.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======= End Layanan Section ======= -->

    </main>
    <!-- ======= End Main Section ======= -->

    <!-- ======= Kontak Section ======= -->
    <section id="contact" class="contact">
        <div class="footer-top mb-5">
            <div class="container mb-5">
                <div class="section-title mb-5">
                    <h2>Kontak</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>TelkomSehat</h3>
                        <br><br><br>
                        <p>
                            Jl. Telekomunikasi <br>
                            Sukapura, Dayeuhkolot <br>
                            Bandung Regency, West Java 40257 <br>
                            Indonesia <br><br>
                            <strong>Phone: </strong> 022 - 287310575 <br>
                            <strong>Email: </strong> cs@telkomedika.co.id <br>
                        </p>
                    </div>

                    <div class="col-lg col-md-6 footer-links">
                        <iframe style="border:0; width: 100%; height: 350px;"
                            src="https://maps.google.com/maps?q=klinik telkomedika telkom unviersity&t=&z=16&ie=UTF 8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"" frameborder=" 0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Kontak Section ======= -->

    <!-- ======= Footer Section ======= -->
    <footer id="footer">
        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    Copyright &copy; 2023 <strong><span>TelkomSehat</span></strong> — All Rights Reserved
                </div>
                <div class="credits">
                    {{-- Designed by <a href="{{ url()->current() }}">SriPandita Team&trade;</a> --}}
                    Designed by
                    <a href="https://github.com/ramhaidar/TelkomSehat_Laravel_10.6.2/graphs/contributors">
                        SriPandita Team&trade;
                    </a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a target="_blank" href="https://twitter.com/TelkoMedika" class="twitter"><i
                        class="bx bxl-twitter"></i></a>
                <a target="_blank" href="https://www.facebook.com/TelkoMedika/" class="facebook"><i
                        class="bx bxl-facebook"></i></a>
                <a target="_blank" href="https://www.instagram.com/telkomedika/" class="instagram"><i
                        class="bx bxl-instagram"></i></a>
            </div>
        </div>
    </footer>
    <!-- ======= End Footer Section ======= -->

    <!-- ======= Arrow Up Button ======= -->
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="fas fa-arrow-up"></i>
    </a>
    <!-- ======= End Arrow Up Button ======= -->
@endsection

@section('bottomScript')
    <!-- Vendor JS -->
    <script src="assets_MDLB/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_MDLB/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_MDLB/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_MDLB/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_MDLB/vendor/php-email-form/validate.js"></script>

    <!-- Main JS -->
    <script src="assets_MDLB/js/main.js"></script>
@endsection
