@section('title', 'Dashboard Penjemputan')

@extends('dashboard.paramedis.dashboard-paramedis-template')

@section('contentx')
    <!-- ======= Breadcrumb Penjemputan Paramedis ======= -->
    <div class="pagetitle">
        <h1>Penjemputan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
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
                                            <form method="POST"
                                                action="{{ route('dashboard.paramedis.penjemputan.action') }}"
                                                id="formJemput{{ $loop->iteration }}">
                                                @csrf
                                                <input type="hidden" name="jemputID" hidden class="form-control" required
                                                    value="{{ $data->id }}">

                                                @if (!isset($berlangsungPenjemputan))
                                                    @if (!$data->paramedis_id)
                                                        <button type="button" class="btn btn-success shadow rounded"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                            href="{{ route('dashboard-pasien-konsultasi') }}"
                                                            id="formTombol">
                                                            <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                            Jemput
                                                        </button>
                                                    @else
                                                        <button type="button" disabled
                                                            class="btn btn-secondary shadow rounded" data-bs-toggle="modal"
                                                            data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                            href="{{ route('dashboard-pasien-konsultasi') }}"
                                                            id="formTombol">
                                                            <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                            Jemput
                                                        </button>
                                                    @endif
                                                @elseif ($berlangsungPenjemputan->paramedis_id == $data->paramedis_id)
                                                    <a target="_blank"
                                                        href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}"
                                                        style="justify-content: center; align-items: center;"
                                                        class="btn btn-primary shadow rounded">
                                                        <i style="padding-right: 10px" class="bi bi-geo-alt"></i>
                                                        Lihat
                                                    </a>
                                                    <input type="hidden" name="selesai" hidden class="form-control"
                                                        required value="done">

                                                    <button type="button" class="btn btn-success shadow rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#SelesaiConfirmation{{ $loop->iteration }}"
                                                        href="{{ route('dashboard-pasien-konsultasi') }}" id="formTombol">
                                                        <i style="padding-right: 10px" class="bi bi-check2-all"></i>
                                                        Selesai
                                                    </button>
                                                @else
                                                    <button type="button" disabled class="btn btn-secondary shadow rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#JemputConfirmation{{ $loop->iteration }}"
                                                        href="{{ route('dashboard-pasien-konsultasi') }}" id="formTombol">
                                                        <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                        Jemput
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="JemputConfirmation{{ $loop->iteration }}"
                                                    tabindex="-1" aria-labelledby="LabelModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin melakukan penjemputan darurat
                                                                {{ $data->pasien->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <a onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()"
                                                                    target="_blank"
                                                                    href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}"
                                                                    style="justify-content: center; align-items: center;"
                                                                    class="btn btn-primary shadow rounded">Jemput</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="SelesaiConfirmation{{ $loop->iteration }}"
                                                    tabindex="-1" aria-labelledby="LabelModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menyelesaikan penjemputan
                                                                {{ $data->pasien->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <a onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()"
                                                                    style="justify-content: center; align-items: center;"
                                                                    class="btn btn-success shadow rounded">Selesai</a>
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
