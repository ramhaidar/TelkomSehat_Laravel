@section('title', 'Dashboard Paramedis')

@extends('dashboard.paramedic._dashboard-paramedic-template')

@section('contentx')
    <!-- ======= Breadcrumb Dashboard Paramedis ======= -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- ======= Breadcrumb Dashboard Paramedis ======= -->

    <!-- ======= Dashboard Paramedis ======= -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card shadow rounded customers-card">
                            <div class="card-body">
                                <h5 class="card-title">TelkomSehat Siap Melayani Anda</h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img class="img-fluid" src="assets_NADM/img/ds_illustrasi.png" alt=""
                                            style="width: 260px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card shadow rounded overflow-auto customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Waktu Sekarang</h5>
                                <h2 id="jam" style="font-size: 18px"></h2>
                                <h2 style="font-size: 18px">
                                    <span id="haritanggal"></span>
                                    <span id="tanggalwaktu"></span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Dashboard Paramedis ======= -->

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
