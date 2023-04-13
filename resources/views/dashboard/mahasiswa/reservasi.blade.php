@section('title', 'Dashboard Reservasi')

@extends('dashboard.mahasiswa.dashboard-mahasiswa-template')

@if (isset($buatReservasi))
    @section('contentx')
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

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

                        <!-- General Form Elements -->
                        <form method="POST" action="{{ route('dashboard.mahasiswa.reservasi.action') }}">
                            <input type="text" name="buatReservasi" hidden class="form-control" required value="{{ $user->id }}">
                            @csrf
                            {{-- <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div> --}}
                            {{-- <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control">
                                    </div>
                                </div> --}}
                            {{-- <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control">
                                    </div>
                                </div> --}}
                            {{-- <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control">
                                    </div>
                                </div> --}}
                            {{-- <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                </div> --}}
                            {{-- <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control">
                                    </div>
                                </div> --}}

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

                            {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Area</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected="">Pilih Area</option>
                                            <option value="JaBar">Jawa Barat</option>
                                            <option value="JaTim">Jawa Timur</option>
                                            <option value="JakTen">Jakarta & Banten</option>
                                            <option value="Sumatra">Sumatra</option>
                                            <option value="Kalimantan">Kalimantan</option>
                                        </select>
                                    </div>
                                </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" id="tanggal" name="tanggal" value="dd-mm-yyyy" class="form-control">
                                </div>

                                {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <script>
                                    $(function() {
                                        $("#tanggal").datepicker({
                                            dateFormat: 'dd-mm-yy',
                                            minDate: 0, // Tanggal minimal adalah hari ini
                                            beforeShowDay: function(date) {
                                                var day = date.getDay();
                                                // Hanya izinkan tanggal Senin-Jumat
                                                return [(day > 0 && day < 6)];
                                            }
                                        });
                                    });
                                </script>
                            </div>

                            {{-- <div class="row mb-3">
                                    <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control">
                                    </div>
                                </div> --}}

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

                            {{-- <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Gejala</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">
                                            <label class="form-check-label" for="gridRadios1">
                                                1-2 hari
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                            <label class="form-check-label" for="gridRadios2">
                                                1-2 Minggu
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                                            <label class="form-check-label" for="gridRadios3">
                                                > 3 Minggu
                                            </label>
                                        </div>
                                    </div>
                                </fieldset> --}}

                            {{-- <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Keterangan</legend>
                                <div class="col-sm-10">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="berobat">
                                        <label class="form-check-label" for="gridCheck1">
                                            Sudah Pernah Berobat
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck2" name="konsultasi">
                                        <label class="form-check-label" for="gridCheck2">
                                            Sudah Pernah Konsultasi
                                        </label>
                                    </div>

                                </div>
                            </div> --}}

                            {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Multi Select</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" multiple="" aria-label="multiple select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success shadow rounded">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
            </div>
        </section>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endsection
@else
    @section('contentx')
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section reservasi">
            <!-- Recent Sales -->
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
                                    {{-- @foreach ($errors->all() as $error) --}}
                                    <li>{{ $succes }}</li>
                                    {{-- @endforeach --}}
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

                                        <script>
                                            function formSubmit() {
                                                document.getElementById("formHapus").submit();
                                                document.getElementsByClassName("form").submit();
                                            }
                                        </script>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <th scope="row"><a href="#">#2457</a></th>
                                    <td>Brandon Jacob</td>
                                    <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                    <td>$64</td>
                                    <td>$64</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                </tr>
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
                                </tr> --}}
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </section>
    @endsection
@endif
