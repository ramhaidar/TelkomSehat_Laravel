@section('title', 'Dashboard Dokter')

@extends('dashboard.dokter.dashboard-dokter-template')

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
    <section class="section reservasi">
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Jadwal Reservasi</h5>
                        </div>

                        {{-- <div class="col-6">
                            <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}">
                                <input type="text" name="buatReservasi" hidden class="form-control" required value="{{ $user->id }}">
                                <button class="btn btn-primary mb-3 mt-3 float-end shadow rounded" href="{{ route('dashboard-mahasiswa-reservasi') }}"><i class="bi bi-plus me-1"></i>Buat Reservasi</button>
                                @csrf
                            </form>
                        </div> --}}
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($succes))
                        <div class="alert alert-success">
                            <ul>
                                {{-- @foreach ($errors->all() as $error) --}}
                                <li>{{ $succes }}</li>
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                    @endif

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Dokter</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataReservasi as $data)
                                <tr>
                                    <th scope="row"><a class="text-primary">{{ $data->mahasiswa->nim }}</a></th>
                                    <td>{{ $data->mahasiswa->user->name }}</td>
                                    <td><a class="text-primary">{{ $data->keluhan }}</a></td>
                                    <td>{{ $data->tanggal }}</td>
                                    @if ($data->waktu == '8')
                                        <td>08:00 - 09:00</td>
                                    @elseif ($data->waktu == '9')
                                        <td>09:00 - 10:00</td>
                                    @elseif ($data->waktu == '10')
                                        <td>10:00 - 11:00</td>
                                    @elseif ($data->waktu == '11')
                                        <td>11:00 - 12:00</td>
                                    @elseif ($data->waktu == '12')
                                        <td>12:00 - 13:00</td>
                                    @elseif ($data->waktu == '13')
                                        <td>13:00 - 14:00</td>
                                    @elseif ($data->waktu == '14')
                                        <td>14:00 - 15:00</td>
                                    @elseif ($data->waktu == '15')
                                        <td>15:00 - 16:00</td>
                                    @endif

                                    @if (isset($data->dokterid))
                                        <td><a class="text-primary">{{ $data->dokter->user->name }}</a></td>
                                    @else
                                        <td><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i></td>
                                    @endif

                                    @if (strtotime($data->tanggal) < strtotime(now()))
                                        <td><span class="badge bg-danger">Rejected</span></td>
                                    @elseif (isset($data->dokterid))
                                        <td><span class="badge bg-success">Approved</span></td>
                                    @elseif (!isset($data->dokterid))
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    @endif
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <th scope="row"><a href="#">#2457</a></th>
                                <td>Brandon Jacob</td>
                                <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                <td>$64</td>
                                <td>$64</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2457</a></th>
                                <td>Brandon Jacob</td>
                                <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                <td>$64</td>
                                <td>$64</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2147</a></th>
                                <td>Bridie Kessler</td>
                                <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                <td>$47</td>
                                <td>$64</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2049</a></th>
                                <td>Ashleigh Langosh</td>
                                <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                <td>$147</td>
                                <td>$64</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2644</a></th>
                                <td>Angus Grady</td>
                                <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                <td>$67</td>
                                <td>$64</td>
                                <td><span class="badge bg-danger">Rejected</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2644</a></th>
                                <td>Raheem Lehner</td>
                                <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                <td>$165</td>
                                <td>$64</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr> --}}
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->
    </section>
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
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
                            document.getElementById("haritanggal").innerHTML = hari[dt.getDay()];
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

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
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

                    </div><!-- End Customers Card -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <div class="row">
                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pr-0">
                            <h5 class="card-title">Status Reservasi <span>| Today</span></h5>
                            <div>
                                <video controls>
                                    <source src="https://www.youtube.com/watch?v=Jg8S09oHmpE" type="video/webm" />
                                    Browsermu tidak mendukung tag ini, upgrade donk!
                                </video>
                            </div>
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

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
