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

    <!-- Template Main CSS File -->
    <link href="assets_MDLB/css/style.css" rel="stylesheet">
@endsection

@section('content')

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto">
                {{-- <a href="index.html">TelkomSehat</a> --}}

                <a href="{{ route('beranda') }}" class="logo d-flex align-items-center w-auto" id="nodecoration">
                    <img src="{{ asset('favicon.ico') }}" alt="">
                    <span class="d-none ms-3 d-lg-block">TelkomSehat</span>
                </a>
            </h1>

            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets_MDLB/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0" style="padding-right: 25px">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            {{-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Login</a> --}}
            {{-- <a href="{{ route('login') }}" class="appointment-btn scrollto"><span class="d-none d-md-inline">Login</a> --}}
            @auth
                <a class="btn btn-danger appointment-btn-red shadow float-end" href="{{ route('logout.action') }}" role="button">Sign-Out</a>
                @if ($users->mahasiswaid)
                    <a class="btn btn-primary appointment-btn shadow float-end" href="{{ route('dashboard-mahasiswa') }}" role="button">Dashboard</a>
                @elseif ($users->dokterid)
                    <a class="btn btn-primary appointment-btn shadow float-end" href="{{ route('dashboard-dokter') }}" role="button">Dashboard</a>
                @elseif ($users->paramedisid)
                    <a class="btn btn-primary appointment-btn shadow float-end" href="{{ route('dashboard-paramedis') }}" role="button">Dashboard</a>
                @endif
            @endauth
            @guest
                <a class="btn btn-primary appointment-btn shadow float-end" href="{{ route('login') }}" role="button">Login</a>
            @endguest
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to TelkomSehat</h1>
            <h2>Sehatkan Hidupmu dengan TelkomSehat, Solusi Kesehatan Digitalmu!</h2>
            {{-- <a href="#about" class="btn-get-started scrollto">Get Started</a> --}}
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Why Choose TelkomSehat?</h3>
                            <p>
                                Telkom Sehat adalah layanan kesehatan online yang disediakan oleh Telkom Indonesia. Layanan ini memudahkan masyarakat Indonesia untuk konsultasi kesehatan secara online, memesan obat yang diantar ke rumah, serta menyediakan informasi kesehatan terkini untuk memberi informasi kesehatan pengguna.
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <h4>Reservasi Jadwal</h4>
                                        <p>Reservasi jadwal pertemuan membantu meminimalkan waktu tunggu dan antrian yang panjang di klinik Telkom Medika</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-check-square"></i>
                                        <h4>Medical Check Up</h4>
                                        <p>Medical checkup atau pemeriksaan kesehatan berkala bertujuan untuk memantau kondisi kesehatan seseorang secara berkala</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-capsule"></i>
                                        <h4>All Medications</h4>
                                        <p>Obat-obatan yang disediakan oleh TelkomSehat sangat lengkap dengan kebutuhan pasien dengan obat resep yang diberikan dokter. </p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>Services</h2>
                    <p>Telkom Sehat adalah layanan kesehatan online yang disediakan oleh Telkom Indonesia. Layanan ini bertujuan untuk memberikan akses mudah dan cepat bagi masyarakat Indonesia untuk konsultasi kesehatan secara online.
                        Pengguna juga dapat memesan obat-obatan yang dibutuhkan dan akan diantar langsung ke rumah pengguna.
                        Selain itu, Telkom Sehat juga menyediakan informasi kesehatan terkini, tips kesehatan, dan artikel kesehatan yang dapat membantu pengguna dalam menjaga kesehatannya.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4><a>Cek Kesehatan</a></h4>
                            <p>Melakukan cek kondisi kesehatan melalui pengisian data atau tes kesehatan untuk mengetahui tanda-tanda penyakit atau kelainan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-pills"></i></div>
                            <h4><a>Pesan Obat</a></h4>
                            <p>Mengajukan permintaan atau memesan obat secara online kepada apoteker atau dokter, sesuai dengan resep atau kebutuhan pribadi.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-hospital-user"></i></div>
                            <h4><a>Konsultasi Dokter</a></h4>
                            <p>Konsultasi dengan dokter atau tenaga medis profesional untuk mendapatkan konsultasi medis, diagnosis, atau rekomendasi pengobatan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-dna"></i></div>
                            <h4><a>Donor Darah</a></h4>
                            <p>Relawan donor darah dan memberikan sumbangan darah kepada mereka yang membutuhkan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-wheelchair"></i></div>
                            <h4><a>Antar-Jemput</a></h4>
                            <p>Layanan antar-jemput pasien atau pengantar obat dari Telkom Medika, untuk memastikan kebutuhan medis terpenuhi dengan nyaman dan efisien.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-notes-medical"></i></div>
                            <h4><a>Laboratorium</a></h4>
                            <p>Pemeriksaan tes medis, seperti tes darah, urin, atau radiologi, untuk membantu dalam diagnosis atau pengelolaan kondisi kesehatan pasien.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <section id="contact" class="contact">
        <div class="footer-top mb-5">
            <div class="container mb-5">
                <div class="section-title mb-5">
                    <h2>Contact</h2>
                    <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>TelkomSehat</h3>
                        <br><br><br>
                        <p>
                            Jl. Telekomunikasi <br>
                            Sukapura, Dayeuhkolot<br>
                            Bandung Regency, West Java 40257<br>
                            Indonesia <br><br>
                            <strong>Phone:</strong> 022 - 287310575<br>
                            <strong>Email:</strong> cs@telkomedika.co.id<br>
                        </p>

                    </div>

                    <div class="col-lg col-md-6 footer-links">
                        <iframe style="border:0; width: 100%; height: 350px;" src="https://maps.google.com/maps?q=klinik telkomedika telkom unviersity&t=&z=16&ie=UTF 8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"" frameborder="0" allowfullscreen></iframe>
                        <!-- <h4>Useful Links</h4>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul> -->
                    </div>

                    <!-- <div class="col-lg-3 col-md-6 footer-links">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h4>Our Services</h4>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="col-lg-4 col-md-6 footer-newsletter">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h4>Join Our Newsletter</h4>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <form action="" method="post">
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="email" name="email"><input type="submit" value="Subscribe">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        </form>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>  -->

                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>TelkomSehat</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="{{ url()->current() }}">YoNdakTauKokTanyaSaya</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a target="_blank" href="https://twitter.com/TelkoMedika" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a target="_blank" href="https://www.facebook.com/TelkoMedika/" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a target="_blank" href="https://www.instagram.com/telkomedika/" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets_MDLB/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_MDLB/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_MDLB/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_MDLB/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_MDLB/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets_MDLB/js/main.js"></script>

@endsection
