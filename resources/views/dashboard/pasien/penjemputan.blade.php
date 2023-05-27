@section('title', 'Dashboard Penjemputan')

@extends('dashboard.pasien.dashboard-pasien-template')

@section('contentx')
    <!-- ======= Breadcrumb Penjemputan Mahasiswa ======= -->
    <div class="pagetitle">
        <h1>Penjemputan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                <li class="breadcrumb-item active">Penjemputan</li>
            </ol>
        </nav>
    </div>
    <!-- ======= End Breadcrumb Penjemputan Mahasiswa ======= -->

    <!-- ======= Penjemputan Mahasiswa ======= -->
    <section class="section profile">
        <div class="col-12">
            <div class="card recent-sales shadow rounded overflow-auto">
                <div class="text-center">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item mx-1">
                                <span class="">Status Penjemputan: </span>
                            </li>

                            @if (!isset($dataPenjemputan) or $dataPenjemputan->selesai == true)
                                <li class="nav-item mx-1">
                                    <span class="badge bg-secondary"><i style="padding-right: 5px"
                                            class="bi bi-collection me-1"></i>Tidak dalam Masa Emergency</span>
                                </li>
                            @elseif (isset($dataPenjemputan) and $dataPenjemputan->paramedis_id)
                                <li class="nav-item mx-1">
                                    <span class="badge bg-success"><i style="padding-right: 5px"
                                            class="bi bi-check-circle me-1"></i>Proses Penjemputan</span>
                                </li>
                            @else
                                <li class="nav-item mx-1">
                                    <span class="badge bg-warning text-dark"><i style="padding-right: 5px"
                                            class="bi bi-exclamation-triangle me-1"></i>Menunggu Konfirmasi Tenaga
                                        Medis</span>
                                </li>
                            @endif
                        </ul>
                        <br>
                        @if (isset($paramedis))
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item mx-1">
                                    <span class="">Tenaga Medis : </span>
                                </li>

                                <li class="nav-item mx-1">
                                    <span class="badge bg-warning text-dark"><i
                                            class="bi bi-telephone me-1"></i>{{ $paramedis->user->name }}</span>
                                </li>

                                <li class="nav-item mx-1">
                                    <span class="badge bg-info text-dark"><i
                                            class="bi bi-info-circle me-1"></i>{{ $paramedis->nomortelepon }}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div class="card-body">
                        <img src="assets_NADM/img/undraw_Location_search_re_ttoj.png" class="img-fluid" alt=""
                            style="width: 260px;">
                        <h1 class="card-title" style="font-size: 250%; font-family: Helvetica"><b>EMERGENCY!</b></h1>
                        <p class="card-text">Penjemputan hanya untuk Keadaan Darurat saja.</p>

                        <form method="POST" action="{{ route('dashboard.pasien.penjemputan.action') }}" id="Penjemputan">
                            @csrf
                            <input type="hidden" name="lintang" class="form-control" required id="lintang">
                            <input type="hidden" name="bujur" class="form-control" required id="bujur">

                            @if (!isset($dataPenjemputan) or $dataPenjemputan->selesai == true)
                                <button type="button" onclick="getLocation()"
                                    class="btn btn-danger mb-2 shadow rounded">Kirim Lokasi Anda</button>
                            @else
                                <button disabled type="button" onclick="getLocation()"
                                    class="btn btn-secondary mb-2 shadow rounded">Kirim Lokasi Anda</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Penjemputan Mahasiswa ======= -->
@endsection

@section('bottomScriptx')
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var inputNama = document.getElementById("lintang");
                    var inputNamaHidden = document.getElementById("bujur");

                    inputNama.value = position.coords.latitude;
                    inputNamaHidden.value = position.coords.longitude;

                    document.getElementById("Penjemputan").submit();
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }
    </script>

    <script src="{{ asset('jquery/jquery-3.6.4.min.js') }}"></script>

    @if (isset($dataPenjemputan))
        <script>
            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            var lastUpdatedAt = null;
            var i = 1;
            setInterval(function() {
                $.ajax({
                    url: '/data/{{ $dataPenjemputan->id }}',
                    type: 'GET',
                    success: function(response) {
                        if (lastUpdatedAt != response && i > 1) {
                            console.log(response)
                            location.reload()
                        }
                        lastUpdatedAt = response
                        i = i + 1
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error.message);
                    }
                });
            }, 5000);
        </script>
    @endif
@endsection
