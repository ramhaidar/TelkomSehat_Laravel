@section('title', 'Dashboard Penjemputan')

@extends('dashboard.paramedis.dashboard-paramedis-template')

{{-- @if (isset($lintang) and isset($bujur))
    @section('contentx')
        <div class="pagetitle">
            <h1>Penjemputan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Penjemputan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <h5 class="card-title">Penjemputan Darurat</h5>

                            <div class="col-lg col-md-6 footer-links">
                                <iframe style="border:0; width: 100%; height: 350px;" src="https://maps.google.com/maps?q={{ $lintang }},{{ $bujur }}&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"" frameborder="0" allowfullscreen></iframe> </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
@else --}}
@section('contentx')
    <div class="pagetitle">
        <h1>Penjemputan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                <li class="breadcrumb-item active">Penjemputan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <h5 class="card-title">Penjemputan Darurat</h5>
                        {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}

                        <!-- Table with stripped rows -->
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
                                        <td>{{ $data->mahasiswa->user->name }}</td>
                                        <td>{{ $data->mahasiswa->nomortelepon }}</td>
                                        <td>{{ $data->lintang }} <br> {{ $data->bujur }}</td>

                                        <td>
                                            <form method="POST" action="{{ route('dashboard.paramedis.penjemputan.action') }}" id="formJemput{{ $loop->iteration }}">
                                                @csrf
                                                <input type="hidden" name="jemputID" hidden class="form-control" required value="{{ $data->id }}">

                                                @if (!isset($berlangsungPenjemputan))
                                                    @if (!$data->paramedisid)
                                                        <button type="button" class="btn btn-success shadow rounded" data-bs-toggle="modal" data-bs-target="#JemputConfirmation{{ $loop->iteration }}" href="{{ route('dashboard-mahasiswa-konsultasi') }}" id="formTombol">
                                                            <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                            Jemput
                                                        </button>
                                                    @else
                                                        <button type="button" disabled class="btn btn-secondary shadow rounded" data-bs-toggle="modal" data-bs-target="#JemputConfirmation{{ $loop->iteration }}" href="{{ route('dashboard-mahasiswa-konsultasi') }}" id="formTombol">
                                                            <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                            Jemput
                                                        </button>
                                                    @endif
                                                @elseif ($berlangsungPenjemputan->paramedisid == $data->paramedisid)
                                                    <a target="_blank" href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}" style="justify-content: center; align-items: center;" class="btn btn-primary shadow rounded">
                                                        <i style="padding-right: 10px" class="bi bi-geo-alt"></i>
                                                        Lihat
                                                    </a>
                                                    <input type="hidden" name="selesai" hidden class="form-control" required value="done">
                                                    {{-- <button class="btn btn-success shadow rounded mx-2">
                                                        <i style="padding-right: 10px" class="bi bi-check2-all"></i>
                                                        Selesai
                                                    </button> --}}
                                                    <button type="button" class="btn btn-success shadow rounded" data-bs-toggle="modal" data-bs-target="#SelesaiConfirmation{{ $loop->iteration }}" href="{{ route('dashboard-mahasiswa-konsultasi') }}" id="formTombol">
                                                        <i style="padding-right: 10px" class="bi bi-check2-all"></i>
                                                        Selesai
                                                    </button>
                                                @else
                                                    <button type="button" disabled class="btn btn-secondary shadow rounded" data-bs-toggle="modal" data-bs-target="#JemputConfirmation{{ $loop->iteration }}" href="{{ route('dashboard-mahasiswa-konsultasi') }}" id="formTombol">
                                                        <i style="padding-right: 10px" class="bi bi-ev-front"></i>
                                                        Jemput
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="JemputConfirmation{{ $loop->iteration }}" tabindex="-1" aria-labelledby="LabelModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin melakukan penjemputan darurat {{ $data->mahasiswa->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()" target="_blank" href="https://maps.google.com/maps?q={{ $data->lintang }},{{ $data->bujur }}" style="justify-content: center; align-items: center;" class="btn btn-primary shadow rounded">Jemput</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="SelesaiConfirmation{{ $loop->iteration }}" tabindex="-1" aria-labelledby="LabelModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="LabelModal">Konfirmasi</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menyelesaikan penjemputan {{ $data->mahasiswa->user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a onclick="document.getElementById('formJemput{{ $loop->iteration }}').submit()" style="justify-content: center; align-items: center;" class="btn btn-success shadow rounded">Selesai</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    function formSubmit() {
                                                        document.getElementById("formJemput").submit();
                                                    }
                                                </script>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
{{-- @endif --}}
