@section('title', 'Dashboard Konsultasi')

@extends('dashboard.dokter.dashboard-dokter-template')

@if (isset($buatKonsultasi))
    @section('contentx')
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section konsultasi">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Form Konsultasi</h5>

                        <!-- Horizontal Form -->
                        <form>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End Horizontal Form -->

                    </div>
                </div>
            </div>
        </section>
    @endsection
@else
    @section('contentx')
        <div class="pagetitle">
            <h1>Konsultasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Konsultasi Dokter</h5>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('dashboard.mahasiswa.konsultasi.action') }}">
                                    <input type="text" name="buatKonsultasi" hidden class="form-control" required value="{{ $user->id }}">
                                    {{-- <button class="btn btn-primary mb-3 mt-3 float-end shadow rounded"><i class="bi bi-plus me-1"></i>Buat Reservasi</button> --}}
                                    {{-- <button class="btn btn-primary mb-3 mt-3 float-end shadow rounded" href="{{ route('dashboard-mahasiswa-konsultasi') }}"><i class="bi bi-chat-square-text"></i> Konsultasi</button> --}}
                                    @csrf
                                </form>
                            </div>
                        </div>
                        {{-- <h5 class="card-title">Reservasi Mahasiswa</h5>
                        <button type="button" class="btn btn-primary mb-3 mt-0 float-end"><i class="bi bi-plus me-1"></i> Buat Reservasi</button> --}}
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
                                        <td>{{ $data->mahasiswa->user->name }}</td>
                                        <td>{{ $data->keluhan }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('dashboard.dokter.konsultasi.action') }}">
                                                @csrf
                                                <input type="text" name="konsultasiID" hidden class="form-control" required value="{{ $data->id }}">

                                                <button type="button" class="btn btn-primary mb-0 mt-0 float-end shadow rounded" data-bs-toggle="modal" data-bs-target="#KonsulatsiModal{{ $loop->iteration }}"><i class="bi bi-chat-square-text"></i></button>

                                                <div class="modal fade" id="KonsulatsiModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="KonsulatsiModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="KonsulatsiModalLabel">Balas Keluhan</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                                    <input type="text" class="form-control" id="recipient-name" disabled value="{{ $data->mahasiswa->user->name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                                    <textarea style="height: 200px" class="form-control" id="message-text" name="jawaban"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Send message</button>
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
            </div><!-- End Recent Sales -->
        </section>
    @endsection
@endif
