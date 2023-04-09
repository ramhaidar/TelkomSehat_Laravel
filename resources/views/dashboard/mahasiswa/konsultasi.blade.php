@section('title', 'Dashboard Konsultasi')

@extends('dashboard.mahasiswa.dashboard-mahasiswa-template')

@section('contentx')
    <main id="main" class="main">
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
                                <h5 class="card-title">Konsultasi</h5>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary mb-3 mt-3 float-end shadow rounded"><i class="bi bi-chat-square-text"></i> Konsultasi</button>
                            </div>
                        </div>
                        {{-- <h5 class="card-title">Reservasi Mahasiswa</h5>
                        <button type="button" class="btn btn-primary mb-3 mt-0 float-end"><i class="bi bi-plus me-1"></i> Buat Reservasi</button> --}}
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Konsultasi</th>
                                    <th scope="col">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>saya sakit kepala kenapa ya?</td>
                                    <td><a href="#" class="text-primary">kEBANYAKAN TUBES ITU MAH</a></td>
                                </tr>
                                <tr>
                                    <td>Bridie Kessler</td>
                                    <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </section>
    </main>
@endsection
