@section('title', 'Dashboard Reservasi')

@extends('dashboard.mahasiswa.dashboard-mahasiswa-template')

@section('style')
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui-1.12.1.css') }}">
@endsection

@section('script')
    <script script src="{{ asset('jquery/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-ui-1.13.2.min.js') }}"></script>
    <script>
        $(function() {
            var now = new Date();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();

            var minDate = (hour > 14 || (hour == 14 && minute >= 59 && second >= 59)) ? 1 : 0;

            let selectedDate = null;

            $("#tanggal").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: minDate,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day > 0 && day < 6)];
                },
                onSelect: function(dateText, inst) {
                    const dateParts = dateText.split("-");
                    const year = dateParts[2];
                    const month = dateParts[1] - 1;
                    const day = dateParts[0];
                    selectedDate = new Date(year, month, day);

                    checkSelectedDate();
                },
            });

            function checkSelectedDate() {
                const today = new Date();
                const selected = new Date(selectedDate);
                var waktuOptions = document.querySelectorAll('select[name="waktu"] option');
                for (var i = 0; i < waktuOptions.length; i++) {
                    waktuOptions[i].hidden = false;
                }
                if (selected.toDateString() === today.toDateString()) {
                    if (hour >= 8 || (hour == 8 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="8"]').hidden = true;
                    }
                    if (hour >= 9 || (hour == 9 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="9"]').hidden = true;
                    }
                    if (hour >= 10 || (hour == 10 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="10"]').hidden = true;
                    }
                    if (hour >= 11 || (hour == 11 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="11"]').hidden = true;
                    }
                    if (hour >= 12 || (hour == 12 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="12"]').hidden = true;
                    }
                    if (hour >= 13 || (hour == 13 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="13"]').hidden = true;
                    }
                    if (hour >= 14 || (hour == 14 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="14"]').hidden = true;
                    }
                    if (hour >= 15 || (hour == 15 && minute >= 55)) {
                        document.querySelector('select[name="waktu"] option[value="15"]').hidden = true;
                    }
                }
            }
        });
    </script>

    <script>
        function formSubmit() {
            document.getElementById("formHapus").submit();
            document.getElementsByClassName("form").submit();
        }
    </script>
@endsection

@if (isset($buatReservasi))
    @section('contentx')
        <!-- ======= Breadcrumb Reservasi Mahasiswa ======= -->
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= End Breadcrumb Reservasi Mahasiswa ======= -->

        <!-- ======= Form Reservasi Mahasiswa ======= -->
        <section class="section reservasi">
            <div class="col-12">
                <div class="card shadow rounded overflow-auto">
                    <div class="card-body shadow rounded">
                        <h5 class="card-title">Form Buat Reservasi Mahasiswa</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}">
                            <input type="text" name="buatReservasi" hidden class="form-control" required value="{{ $user->id }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Dokter</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="dokter">
                                        <option selected="">Pilih Dokter</option>
                                        <option value="Dokter Gigi">Dokter Gigi</option>
                                        <option value="Dokter Umum">Dokter Umum</option>
                                        <option value="Dokter Kulit">Dokter Kulit</option>
                                        <option value="Psikiater">Psikiater</option>
                                        <option value="Dokter THT">Dokter THT</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" id="tanggal" name="tanggal" value="dd-mm-yyyy" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="waktu" aria-label="Default select example">
                                        <option selected="">Pilih Waktu</option>
                                        <option value="8">08:00 - 09:00</option>
                                        <option value="9">09:00 - 10:00</option>
                                        <option value="10">10:00 - 11:00</option>
                                        <option value="11">11:00 - 12:00</option>
                                        <option value="12">12:00 - 13:00</option>
                                        <option value="13">13:00 - 14:00</option>
                                        <option value="14">14:00 - 15:00</option>
                                        <option value="15">15:00 - 16:00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px" name="keluhan"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success shadow rounded">Submit Form</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End Form Reservasi Mahasiswa ======= -->
    @endsection
@else
    @section('contentx')
        <!-- ======= Breadcrumb Reservasi Mahasiswa ======= -->
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= Breadcrumb Reservasi Mahasiswa ======= -->

        <!-- ======= Reservasi Mahasiswa ======= -->
        <section class="section reservasi">
            <div class="col-12">
                <div class="card shadow rounded overflow-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Reservasi Mahasiswa</h5>
                            </div>

                            <div class="col-6">
                                <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}">
                                    <input type="text" name="buatReservasi" hidden class="form-control" required value="{{ $user->id }}">
                                    <button class="btn btn-primary mb-3 mt-3 shadow rounded float-end" href="{{ route('dashboard-mahasiswa-reservasi') }}"><i style="padding-right: 10px" class="bi bi-calendar2-plus"></i>Buat Reservasi</button>
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
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Spesialis</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataReservasi as $data)
                                    <tr>
                                        <th scope="row"><a class="text-primary">{{ $user->mahasiswa->nim }}</a></th>
                                        <td>{{ $user->name }}</td>
                                        <td><a class="text-primary">{{ $data->keluhan }}</a></td>
                                        <td>{{ $data->tanggal }}</td>
                                        @if ($data->waktu == '8')
                                            <td>08:00 - 09:00</td>
                                        @elseif ($data->waktu == '9')
                                            <td>09:00 - 10:00</td>
                                        @elseif ($data->waktu == '10')
                                            <td>10:00 - 11:00</td>
                                        @elseif ($data->waktu == '11')
                                            <td>11:00 - 12:00</td>
                                        @elseif ($data->waktu == '12')
                                            <td>12:00 - 13:00</td>
                                        @elseif ($data->waktu == '13')
                                            <td>13:00 - 14:00</td>
                                        @elseif ($data->waktu == '14')
                                            <td>14:00 - 15:00</td>
                                        @elseif ($data->waktu == '15')
                                            <td>15:00 - 16:00</td>
                                        @endif

                                        @if (isset($data->dokterid))
                                            <td><a class="text-primary">{{ $data->dokter->user->name }}</a></td>
                                        @else
                                            <td><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i></td>
                                        @endif

                                        <td>{{ $data->spesialis }}</td>

                                        @if ($data->waktu == '8' or $data->waktu == '9')
                                            @if (strtotime($data->tanggal . ' 0' . $data->waktu . ':00') < strtotime(now()) and !isset($data->dokterid))
                                                <td><span class="badge bg-danger shadow rounded">Rejected</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @endif
                                        @else
                                            @if (strtotime($data->tanggal . ' ' . $data->waktu . ':00') < strtotime(now()) and !isset($data->dokterid))
                                                <td><span class="badge bg-danger shadow rounded">Rejected</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @endif
                                        @endif

                                        @if ($data->waktu == '8' or $data->waktu == '9')
                                            @if (strtotime($data->tanggal . ' 0' . $data->waktu . ':00') < strtotime(now()) and isset($data->dokterid))
                                                <td><span class="badge bg-secondary shadow rounded">Completed</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @elseif (isset($data->dokterid))
                                                <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @elseif (!isset($data->dokterid))
                                                <td><span class="badge bg-warning shadow rounded">Pending</span></td>
                                                <td>
                                                    <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}" id="formHapus{{ $loop->iteration }}">
                                                        @csrf
                                                        <input type="hidden" hidden name="hapusID" hidden class="form-control" required value="{{ $data->id }}">
                                                        <a onclick="document.getElementById('formHapus{{ $loop->iteration }}').submit()" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</a>
                                                    </form>
                                                </td>
                                            @endif
                                        @else
                                            @if (strtotime($data->tanggal . ' ' . $data->waktu . ':00') < strtotime(now()) and isset($data->dokterid))
                                                <td><span class="badge bg-secondary shadow rounded">Completed</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @elseif (isset($data->dokterid))
                                                <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                                <td>
                                                    <button disabled style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</button>
                                                </td>
                                            @elseif (!isset($data->dokterid))
                                                <td><span class="badge bg-warning shadow rounded">Pending</span></td>
                                                <td>
                                                    <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}" id="formHapus{{ $loop->iteration }}">
                                                        @csrf
                                                        <input type="hidden" hidden name="hapusID" hidden class="form-control" required value="{{ $data->id }}">
                                                        <a onclick="document.getElementById('formHapus{{ $loop->iteration }}').submit()" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-sm btn-danger shadow rounded"><i style="padding-right: 10px" class="bi bi-x-circle"></i>Batal</a>
                                                    </form>
                                                </td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End Reservasi Mahasiswa ======= -->

    @endsection
@endif
