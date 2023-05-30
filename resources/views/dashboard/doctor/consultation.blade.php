@section('title', 'Dashboard Konsultasi')

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

@if (isset($buatKonsultasi))
    @section('contentx')
        <!-- ======= Breadcrumb Konsultasi Dokter ======= -->
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= End Breadcrumb Konsultasi Dokter ======= -->

        <!-- ======= Form Konsultasi Dokter ======= -->
        <section class="section konsultasi">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Form Konsultasi</h5>
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="inputPassword">Keluhan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End Form Konsultasi Dokter ======= -->
    @endsection
@else
    @section('contentx')
        <!-- ======= Breadcrumb Konsultasi Dokter ======= -->
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= End Breadcrumb Konsultasi Dokter ======= -->

        <!-- ======= Konsultasi Dokter ======= -->
        <section class="section profile">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
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

                                                <button class="btn btn-primary mb-0 mt-0 shadow rounded"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#KonsulatsiModal{{ $loop->iteration }}"
                                                    type="button"><i class="bi bi-chat-square-text"
                                                        style="padding-right: 10px"></i>Balas</button>

                                                <div class="modal fade" id="KonsulatsiModal{{ $loop->iteration }}"
                                                    aria-labelledby="KonsulatsiModalLabel" aria-hidden="true"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="KonsulatsiModalLabel">Balas
                                                                    Keluhan</h1>
                                                                <button class="btn-close" data-bs-dismiss="modal"
                                                                    type="button" aria-label="Close"></button>
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
                                                                        for="message-text">Jawaban:</label>
                                                                    <textarea class="form-control" id="message-text" name="jawaban" style="height: 200px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary shadow rounded"
                                                                    data-bs-dismiss="modal" type="button">Close</button>
                                                                <button class="btn btn-success shadow rounded"
                                                                    type="submit">Kirim
                                                                    Jawaban</button>
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
        <!-- ======= End Konsultasi Dokter ======= -->
    @endsection
@endif
