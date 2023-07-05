@section('title', 'Dashboard Reservasi')

@extends('dashboard.doctor._dashboard-doctor-template')

@section('contentx')
    <!-- ======= Breadcrumb Reservasi Dokter ======= -->
    <div class="pagetitle">
        <h1>Reservasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Reservasi</li>
            </ol>
        </nav>
    </div>
    <!-- ======= End Breadcrumb Reservasi Dokter ======= -->

    <!-- ======= Reservasi Dokter ======= -->
    <section class="section reservasi">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Reservasi Dokter</h5>
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

                    @if (isset($succes))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ $succes }}</li>
                            </ul>
                        </div>
                    @endif

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                {{-- <th scope="col">NIM</th> --}}
                                <th scope="col">Nama</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataReservation as $data)
                                <tr>
                                    {{-- <th scope="row"><a class="text-primary">{{ $data->pasien->nim }}</a></th> --}}
                                    <td>{{ $data->patient->user->name }}</td>
                                    <td><a class="text-primary">{{ $data->complaint }}</a></td>
                                    <td>{{ $data->date }}</td>
                                    @if ($data->time == '8')
                                        <td>08:00 - 09:00</td>
                                    @elseif ($data->time == '9')
                                        <td>09:00 - 10:00</td>
                                    @elseif ($data->time == '10')
                                        <td>10:00 - 11:00</td>
                                    @elseif ($data->time == '11')
                                        <td>11:00 - 12:00</td>
                                    @elseif ($data->time == '12')
                                        <td>12:00 - 13:00</td>
                                    @elseif ($data->time == '13')
                                        <td>13:00 - 14:00</td>
                                    @elseif ($data->time == '14')
                                        <td>14:00 - 15:00</td>
                                    @elseif ($data->time == '15')
                                        <td>15:00 - 16:00</td>
                                    @endif

                                    <td>
                                        <form method="POST" action="{{ route('dashboard.dokter.reservasi.action') }}">
                                            @csrf
                                            <input class="form-control" name="reservasiID" type="text"
                                                value="{{ $data->id }}" hidden required>

                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#ApproveConfirmation{{ $loop->iteration }}" type="button"
                                                href="{{ route('dashboard-pasien-konsultasi') }}">
                                                <i class="bi bi-check-circle"></i>
                                                <span style="padding-left: 10px">Approve</span>
                                            </button>

                                            <div class="modal fade" id="ApproveConfirmation{{ $loop->iteration }}"
                                                aria-labelledby="LabelModal" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                            <button class="btn-close" data-bs-dismiss="modal" type="button"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menyetujui reservasi
                                                            {{ $data->patient->user->name }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                                type="button">Close</button>
                                                            <button class="btn btn-primary">Approve</button>
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
    <!-- ======= End Reservasi Dokter ======= -->
@endsection
