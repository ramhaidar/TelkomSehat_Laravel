@section('title', 'Dashboard Dokter')

@extends('dashboard.dokter.dashboard-dokter-template')

@section('style')
    <style>
        #A01 {
            position: relative;
            width: 100%;
            height: 100px;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            padding: 0.375rem 0.75rem;
            background: #e9ecef;
        }

        #A02 {
            height: 100%;
            overflow: auto;
            font-size: 1rem;
        }
    </style>
@endsection

@section('contentx')
    <!-- ======= Breadcrumb Dashboard Dokter ======= -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- ======= Breadcrumb Dashboard Dokter ======= -->

    <!-- ======= Dashboard ======= -->
    <section class="section reservasi">
        <div class="col-12">
            <div class="card shadow rounded overflow-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Jadwal Reservasi</h5>
                        </div>
                    </div>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                {{-- <th scope="col">NIM</th> --}}
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
                                    {{-- <th scope="row"><a class="text-primary">{{ $data->pasien->nim }}</a></th> --}}
                                    <td>{{ $data->pasien->user->name }}</td>
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

                                    @if (isset($data->dokter_id))
                                        <td><a class="text-primary">{{ $data->dokter->user->name }}</a></td>
                                    @else
                                        <td><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i><i
                                                class="bi bi-dash-lg"></i></td>
                                    @endif

                                    @if (isset($data->dokter_id))
                                        @if (strtotime($data->tanggal . ' ' . $data->waktu . ':00') < strtotime(now()))
                                            <td><span class="badge bg-secondary shadow rounded">Completed</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger shadow rounded"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    disabled><i class="bi bi-x-circle"
                                                        style="padding-right: 10px"></i>Batal</button>
                                            </td>
                                        @else
                                            @if (($data->waktu == '8' or $data->waktu == '9') and isset($data->dokter_id))
                                                <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                            @else
                                                <td><span class="badge bg-warning shadow rounded">Approved</span></td>
                                            @endif
                                            <td>
                                                <button class="btn btn-sm btn-danger shadow rounded"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    disabled><i class="bi bi-x-circle"
                                                        style="padding-right: 10px"></i>Batal</button>
                                            </td>
                                        @endif
                                    @else
                                        @if (strtotime($data->tanggal . ' ' . $data->waktu . ':00') < strtotime(now()))
                                            <td><span class="badge bg-danger shadow rounded">Rejected</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger shadow rounded"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    disabled><i class="bi bi-x-circle"
                                                        style="padding-right: 10px"></i>Batal</button>
                                            </td>
                                        @else
                                            @if (($data->waktu == '8' or $data->waktu == '9') and isset($data->dokter_id))
                                                <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                            @else
                                                <td><span class="badge bg-warning shadow rounded">Approved</span></td>
                                            @endif
                                            <td>
                                                <form id="formHapus{{ $loop->iteration }}" method="POST"
                                                    action="{{ route('dashboard.pasien.reservasi.action') }}">
                                                    @csrf
                                                    <input class="form-control" name="hapusID" type="hidden"
                                                        value="{{ $data->id }}" hidden hidden required>
                                                    <a class="btn btn-sm btn-danger shadow rounded"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        onclick="document.getElementById('formHapus{{ $loop->iteration }}').submit()"><i
                                                            class="bi bi-x-circle" style="padding-right: 10px"></i>Batal</a>
                                                </form>
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="section profile">
        <div class="col-12">
            <div class="card recent-sales shadow rounded overflow-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Konsultasi Dokter</h5>
                        </div>
                        <div class="col-6">
                            <form method="POST" action="{{ route('dashboard.pasien.konsultasi.action') }}">
                                <input class="form-control" name="buatKonsultasi" type="text"
                                    value="{{ $user->id }}" hidden required>
                                @csrf
                            </form>
                        </div>
                    </div>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKonsultasi as $data)
                                <tr>
                                    <td>{{ $data->pasien->user->name }}</td>
                                    <td>{{ $data->keluhan }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('dashboard.dokter.konsultasi.action') }}">
                                            @csrf
                                            <input class="form-control" name="konsultasiID" type="text"
                                                value="{{ $data->id }}" hidden required>

                                            <button class="btn btn-secondary mb-0 mt-0 shadow rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#KonsulatsiModal{{ $loop->iteration }}" type="button"><i
                                                    class="bi bi-book" style="padding-right: 10px"></i>Lihat</button>

                                            <div class="modal fade" id="KonsulatsiModal{{ $loop->iteration }}"
                                                aria-labelledby="KonsulatsiModalLabel" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="KonsulatsiModalLabel">Balas
                                                                Keluhan</h1>
                                                            <button class="btn-close" data-bs-dismiss="modal" type="button"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="col-form-label"
                                                                    for="recipient-name">Kepada:</label>
                                                                <input class="form-control" id="recipient-name"
                                                                    type="text"
                                                                    value="{{ $data->pasien->user->name }}" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="col-form-label"
                                                                    for="recipient-name">Keterangan:</label>
                                                                <div class="form-control" id="A01">
                                                                    <div class="input-content" id="A02">
                                                                        <p>{{ $data->keterangan }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="col-form-label"
                                                                    for="recipient-name">Jawaban:</label>
                                                                <div class="form-control" id="A01">
                                                                    <div class="input-content" id="A02">
                                                                        <p>{{ $data->jawaban }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary shadow rounded"
                                                                data-bs-dismiss="modal" type="button">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
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

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card shadow rounded overflow-auto customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Reservasi </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $myReservasi }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">from {{ $countReservasi }}
                                            total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
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
