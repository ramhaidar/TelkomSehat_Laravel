@section('title', 'Dashboard Penjemputan')

@extends('dashboard.paramedis.dashboard-paramedis-template')

@section('contentx')
    <!-- ======= Breadcrumb Penjemputan Paramedis ======= -->
    <div class="pagetitle">
        <h1>Penjemputan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Penjemputan</li>
            </ol>
        </nav>
    </div>
    <!-- ======= Breadcrumb Reservasi Paramedis ======= -->

    <!-- ======= Penjemputan Paramedis ======= -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <h5 class="card-title">Penjemputan Darurat</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Koordinat Lokasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPenjemputan as $data)
                                    <tr>
                                        <td>{{ $data->pasien->user->name }}</td>
                                        <td>{{ $data->pasien->nomortelepon }}</td>
                                        <td>{{ $data->lintang }} <br> {{ $data->bujur }}</td>

                                        <td>
                                            <form id="formJemput{{ $loop->iteration }}" method="POST"
                                                action="{{ route('dashboard.paramedis.penjemputan.action') }}">
                                                @csrf
                                                <input class="form-control" name="jemputID" type="hidden"
                                                    value="{{ $data->id }}" hidden required>

                                                @if (!isset($berlangsungPenjemputan))
                                                    @if (!$data->paramedis_id)
                                                        <button class="btn btn-success shadow rounded" id="formTombol"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                            type="button"
                                                            href="{{ route('dashboard-pasien-konsultasi') }}">
                                                            <i class="bi bi-ev-front" style="padding-right: 10px"></i>
                                                            Jemput
                                                        </button>
                                                    @else
                                                        <button class="btn btn-secondary shadow rounded" id="formTombol"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                            type="button"
                                                            href="{{ route('dashboard-pasien-konsultasi') }}" disabled>
                                                            <i class="bi bi-ev-front" style="padding-right: 10px"></i>
                                                            Jemput
                                                        </button>
                                                    @endif
                                                @elseif ($berlangsungPenjemputan->paramedis_id == $data->paramedis_id)
                                                    <a class="btn btn-primary shadow rounded"
                                                        href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}"
                                                        style="justify-content: center; align-items: center;"
                                                        target="_blank">
                                                        <i class="bi bi-geo-alt" style="padding-right: 10px"></i>
                                                        Lihat
                                                    </a>
                                                    <input class="form-control" name="selesai" type="hidden" value="done"
                                                        hidden required>

                                                    <button class="btn btn-success shadow rounded" id="formTombol"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#SelesaiConfirmation{{ $loop->iteration }}"
                                                        type="button" href="{{ route('dashboard-pasien-konsultasi') }}">
                                                        <i class="bi bi-check2-all" style="padding-right: 10px"></i>
                                                        Selesai
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary shadow rounded" id="formTombol"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                        type="button" href="{{ route('dashboard-pasien-konsultasi') }}"
                                                        disabled>
                                                        <i class="bi bi-ev-front" style="padding-right: 10px"></i>
                                                        Jemput
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="JemputConfirmation{{ $loop->iteration }}"
                                                    aria-labelledby="LabelModal" aria-hidden="true" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button class="btn-close" data-bs-dismiss="modal"
                                                                    type="button" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin melakukan penjemputan darurat
                                                                {{ $data->pasien->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                                    type="button">Batal</button>
                                                                <a class="btn btn-primary shadow rounded"
                                                                    href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}"
                                                                    style="justify-content: center; align-items: center;"
                                                                    onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()"
                                                                    target="_blank">Jemput</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="SelesaiConfirmation{{ $loop->iteration }}"
                                                    aria-labelledby="LabelModal" aria-hidden="true" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button class="btn-close" data-bs-dismiss="modal"
                                                                    type="button" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menyelesaikan penjemputan
                                                                {{ $data->pasien->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                                    type="button">Batal</button>
                                                                <a class="btn btn-success shadow rounded"
                                                                    style="justify-content: center; align-items: center;"
                                                                    onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()">Selesai</a>
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
        </div>
    </section>
    <!-- ======= End Penjemputan Paramedis ======= -->
@endsection

@section('bottomScriptx')
    <script>
        function formSubmit() {
            document.getElementById("formJemput").submit();
        }
    </script>
@endsection
