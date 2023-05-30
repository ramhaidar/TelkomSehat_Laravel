@section('title', 'Dashboard Konsultasi')

@extends('dashboard.patient._dashboard-patient-template')

@section('style')
    <style>
        #teksPanjang {
            max-width: 500px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #jorokKanan {
            text-align: right;
            height: 1px;
        }
    </style>
@endsection

@if (isset($buatKonsultasi))
    @section('contentx')
        <!-- ======= Breadcrumb Konsultasi Pasien ======= -->
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= Breadcrumb Konsultasi Pasien ======= -->

        <hr class="border-2 border-top border-dark">

        <!-- ======= Form Konsultasi Pasien ======= -->
        <section class="section konsultasi">
            <div class="col-12">
                <div class="card recent-sales shadow rounded overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Form Konsultasi Pasien</h5>
                        <form method="POST" action="{{ route('dashboard.patient.consultation.action') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label py-3" for="keluhan">Keluhan</label>
                                <div class="col-sm-10 py-3">
                                    <input class="form-control" name="keluhan" type="text" required maxlength="84">
                                </div>
                                <label class="col-sm-2 col-form-label py-3" for="keterangan">Keterangan</label>
                                <div class="col-sm-10 py-3">
                                    <textarea class="form-control" name="keterangan" style="height: 100px" required></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary shadow rounded" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    <!-- ======= End Form Konsultasi Pasien ======= -->
@else
    <!-- ======= Breadcrumb Konsultasi Pasien ======= -->
    @section('contentx')
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= End Breadcrumb Konsultasi Pasien ======= -->

        <hr class="border-2 border-top border-dark">

        <!-- ======= Konsultasi Pasien ======= -->
        <section class="section profile">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Konsultasi Pasien</h5>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('dashboard.patient.consultation.action') }}">
                                    <input class="form-control" name="buatKonsultasi" type="text"
                                        value="{{ $user->id }}" hidden required>
                                    <button class="btn btn-primary mb-3 mt-3 float-end shadow rounded"
                                        href="{{ route('dashboard-patient-consultation') }}"><i
                                            class="bi bi-chat-square-text"></i> Konsultasi</button>
                                    @csrf
                                </form>
                            </div>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Keluhan</th>
                                    <th id="jorokKanan" scope="col">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataConsultation as $data)
                                    <tr>
                                        <td>{{ $data->complaint }}</td>
                                        <td>
                                            @if (isset($data->answer))
                                                <button class="btn btn-success shadow rounded" data-bs-toggle="modal"
                                                    data-bs-target="#ModalJawaban{{ $loop->iteration }}" type="button"
                                                    style="width: 120px">
                                                @else
                                                    <button class="btn btn-secondary shadow rounded" data-bs-toggle="modal"
                                                        data-bs-target="#ModalJawaban{{ $loop->iteration }}" type="button"
                                                        style="width: 120px">
                                            @endif
                                            <i class="bi bi-file-earmark-check" style="padding-right: 10px"></i>Lihat
                                            </button>

                                            <div class="modal fade" id="ModalJawaban{{ $loop->iteration }}">
                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="ModalJawabanLabel">
                                                                {{ $data->complaint }}</h1>
                                                            <button class="btn-close" data-bs-dismiss="modal" type="button"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (isset($data->doctor))
                                                                <h6><b>Dokter: </b>{{ $data->doctor->user->name }}
                                                                    <strong>[{{ $data->doctor->doctor_Code }}]</strong>
                                                                </h6>
                                                            @else
                                                                <h6><b>Dokter: </b> -</h6>
                                                            @endif
                                                            <div class="border-top border-secondary border-2 my-3"></div>
                                                            <h6><b>Keterangan:</b></h6>
                                                            <p>{{ $data->annotation }}</p>
                                                            <div class="border-top border-secondary border-2 my-3"></div>
                                                            <h6><b>Jawaban:</b></h6>
                                                            @if (isset($data->answer))
                                                                <p>{{ $data->answer }}</p>
                                                            @else
                                                                <p class="text text-secondary">// Belum ada Jawaban dari
                                                                    Dokter //</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                                type="button">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End Konsultasi Pasien ======= -->
    @endsection
@endif
