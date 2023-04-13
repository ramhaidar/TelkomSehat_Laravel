@section('title', 'Dashboard Paramedis')

@extends('dashboard.paramedis.dashboard-paramedis-template')

@section('contentx')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card shadow rounded customers-card">
                            <div class="card-body">
                                <h5 class="card-title">TelkomSehat Siap Melayani Anda</h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img src="assets_NADM/img/ds_illustrasi.png" class="img-fluid" alt="" style="width: 260px;">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

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
                        <script type="text/javascript">
                            var dt = new Date();
                            var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            document.getElementById("haritanggal").innerHTML = hari[dt.getDay()] + ', ';
                            document.getElementById("tanggalwaktu").innerHTML = set(dt.getDate()) + '-' + set(dt.getMonth() + 1) + '-' + dt.getFullYear();
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

                                // konversi ke format 12 jam
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
                    </div><!-- End Customers Card -->

                    {{-- <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card shadow rounded customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Reservasi </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $myReservasi }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">from {{ $countReservasi }} total</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card --> --}}

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            {{-- <div class="col-lg-4">
                <div class="row">
                    <!-- Website Traffic -->
                    <div class="card shadow rounded">
                        <div class="card-body pr-0">
                            <h5 class="card-title">Status Reservasi <span>| Today</span></h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Access From',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: [{
                                                    value: 580,
                                                    name: 'Approve'
                                                },
                                                {
                                                    value: 484,
                                                    name: 'Pending'
                                                },
                                                {
                                                    value: 300,
                                                    name: 'Decline'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- News & Updates Traffic -->
                    <div class="card">
                        <div class="filter">
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns --> --}}

        </div>
    </section>

@endsection
