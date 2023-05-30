@section('title', 'Dashboard Pasien')

@extends('dashboard.patient._dashboard-patient-template')

@section('style')
    <style>
        .card-wrapper {
            height: 250px;
            /* set a fixed height */
            width: 250px;
            /* set a fixed width */
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
@endsection

@section('contentx')
    <!-- ======= Breadcrumb ======= -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- ======= End Breadcrumb ======= -->

    <hr class="border-2 border-bottom border-dark">

    <!-- ======= Dashboard ======= -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg">
                <div class="row">

                    <div class="col-xxl-4 col-xl-12 card-wrapper">
                        <div class="card info-card shadow rounded customers-card h-100">
                            <h5 class="card-title text-center">TelkomSehat Siap Melayani Anda</h5>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img class="img-fluid" src="assets_NADM/img/ds_illustrasi.png" alt=""
                                            style="width: 260px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12 card-wrapper">
                        <div class="card info-card shadow rounded customers-card h-100">
                            <h5 class="card-title text-center">Waktu Sekarang</h5>

                            <div class="card-body">
                                <h2 id="jam" style="font-size: 18px"></h2>
                                <h2 style="font-size: 18px">
                                    <span id="haritanggal"></span>
                                    <span id="tanggalwaktu"></span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12 card-wrapper">
                        <div class="card info-card shadow rounded customers-card h-100">
                            <h5 class="card-title text-center">Jumlah Reservasi </h5>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <div class="ps-3">
                                        <h6>{{ $myReservation }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">from {{ $countReservation }}
                                            total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Dashboard ======= -->
@endsection

@section('bottomScriptx')
    <!-- ======= Script Tanggal dan Waktu ======= -->
    <script>
        var dt = new Date();
        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        document.getElementById("haritanggal").innerHTML = hari[dt.getDay()] + ', ';
        document.getElementById("tanggalwaktu").innerHTML = set(dt.getDate()) + '-' + set(dt.getMonth() + 1) + '-' + dt
            .getFullYear();
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s, ampm;
            h = d.getHours();
            m = d.getMinutes();
            s = d.getSeconds();

            if (h == 0) {
                h = 12;
                ampm = "AM";
            } else if (h > 12) {
                h = h - 12;
                ampm = "PM";
            } else if (h == 12) {
                ampm = "PM";
            } else {
                ampm = "AM";
            }

            e.innerHTML = set(h) + ':' + set(m) + ':' + set(s) + ' ' + ampm;

            setTimeout(jam, 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>
    <!-- ======= End Script Tanggal dan Waktu ======= -->
@endsection
