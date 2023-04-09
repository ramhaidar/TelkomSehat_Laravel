@section('title', 'Dashboard Reservasi')

@extends('dashboard.mahasiswa.dashboard-mahasiswa-template')

@section('contentx')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
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
                                <h5 class="card-title">Reservasi Mahasiswa</h5>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary mb-3 mt-3 float-end shadow rounded"><i class="bi bi-plus me-1"></i> Buat Reservasi</button>
                            </div>
                        </div>
                        {{-- <h5 class="card-title">Reservasi Mahasiswa</h5>
                        <button type="button" class="btn btn-primary mb-3 mt-0 float-end"><i class="bi bi-plus me-1"></i> Buat Reservasi</button> --}}
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keperluan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </section>
    </main>
@endsection
