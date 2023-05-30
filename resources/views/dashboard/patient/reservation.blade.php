@section('title', 'Dashboard Reservasi')

@extends('dashboard.patient._dashboard-patient-template')

@section('style')
    {{-- <link href="{{ asset('jquery/jquery-ui-1.12.1.css') }}" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" rel="stylesheet"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/theme.min.css" rel="stylesheet"
        integrity="sha512-hbs/7O+vqWZS49DulqH1n2lVtu63t3c3MTAn0oYMINS5aT8eIAbJGDXgLt6IxDHcWyzVTgf9XyzZ9iWyVQ7mCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('bottomScriptx')
    {{-- <script src="{{ asset('jquery/jquery-3.6.4.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('jquery/jquery-ui-1.13.2.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var IsDateSelected = false;
        var IsTimeSelected = false;
        var IsDokterSelected = false;

        var DokterSelected;
        var DateSelected;
        var TimeSelected;

        var AvailableDoctor;
    </script>

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


                    // const waktuSelect = document.getElementById('waktu');
                    // waktuSelect.removeAttribute('disabled');
                    // waktuSelect.selectedIndex = 0;

                    var waktuSelect = $('#waktu');
                    // waktuSelect.empty();
                    // waktuSelect.append('<option value=null selected="">Pilih Waktu</option>');
                    waktuSelect.find('option').slice(1).prop('hidden', true);
                    waktuSelect.removeAttr('disabled');
                    waktuSelect.prop('selectedIndex', 0);

                    checkSelectedDate();

                    var dokterSelect = $('#dokter');
                    dokterSelect.empty();
                    dokterSelect.append('<option value=null selected="">Pilih Dokter</option>');

                    IsDateSelected = true;
                    IsTimeSelected = false;

                    DateSelected = $(this).val();

                    checkDateAndTime($(this).val());
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

    <script>
        var select = document.querySelector('select[name="waktu"]');

        select.addEventListener('change', function() {
            TimeSelected = this.value;
            IsTimeSelected = true;
            checkDateAndTime()
        });
    </script>

    <script>
        function checkDateAndTime() {
            if (IsDateSelected && IsTimeSelected) {
                $.ajax({
                    url: '/api/get_available_doctor',
                    type: 'POST',
                    data: {
                        tanggal: DateSelected,
                        waktu: TimeSelected,
                    },
                    success: function(response) {
                        AvailableDoctor = Array.from(response.data);

                        checkAvailableDoctor();
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            }
        }
    </script>

    <script>
        function checkAvailableDoctor() {
            if (AvailableDoctor) {
                var select = $('#dokter');

                select.empty();
                select.append('<option value=null selected="">Pilih Dokter</option>');
                $.each(AvailableDoctor, function(index, value) {
                    console.log(value);
                    select.append(
                        '<option value="' + value.id + '">' + value.speciality + " (" +
                        value.users[0].name + ")" + '</option>'
                    );
                });
                select.prop('disabled', false);
            }
        }
    </script>

    <script>
        var select = document.querySelector('select[name="dokter"]');

        select.addEventListener('change', function() {
            DokterSelected = this.value;
            IsDokterSelected = true;
            checkSelectedDoctor()
        });

        function checkSelectedDoctor() {
            if (DokterSelected) {
                var select = $('#keluhan');
                select.prop('disabled', false);
            }
        }
    </script>
@endsection

@if (isset($makeReservation))
    @section('contentx')
        <!-- ======= Breadcrumb Reservasi Pasien ======= -->
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= End Breadcrumb Reservasi Pasien ======= -->

        <hr class="border-2 border-top border-dark">

        <!-- ======= Form Reservasi Pasien ======= -->
        <section class="section reservasi">
            <div class="col-12">
                <div class="card shadow rounded overflow-auto">
                    <div class="card-body shadow rounded">
                        <h5 class="card-title">Form Buat Reservasi Pasien</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('dashboard.patient.reservation.action') }}">
                            <input class="form-control" name="buatReservasi" type="text" value="{{ $user->id }}"
                                hidden required>
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="tanggal" name="tanggal" type="text"
                                        value="Pilih Tanggal">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="waktu" name="waktu" disabled>
                                        <option value=null selected="">Pilih Waktu</option>
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
                                <label class="col-sm-2 col-form-label">Dokter</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="dokter" name="dokter" disabled>
                                        <option value=null selected="">Pilih Dokter</option>
                                        {{-- <option value="Dokter Gigi">Dokter Gigi</option>
                                        <option value="Dokter Umum">Dokter Umum</option>
                                        <option value="Dokter Kulit">Dokter Kulit</option>
                                        <option value="Psikiater">Psikiater</option>
                                        <option value="Dokter THT">Dokter THT</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="keluhan">Keluhan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="keluhan" name="keluhan" style="height: 100px" disabled></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button class="btn btn-success shadow rounded" type="submit">Submit Form</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End Form Reservasi Pasien ======= -->
    @endsection
@else
    @section('contentx')
        <!-- ======= Breadcrumb Reservasi Pasien ======= -->
        <div class="pagetitle">
            <h1>Reservasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservasi</li>
                </ol>
            </nav>
        </div>
        <!-- ======= Breadcrumb Reservasi Pasien ======= -->

        <hr class="border-2 border-top border-dark">

        <!-- ======= Reservasi Pasien ======= -->
        <section class="section reservasi">
            <div class="col-12">
                <div class="card shadow rounded overflow-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Reservasi Pasien</h5>
                            </div>

                            <div class="col-6">
                                <form method="POST" action="{{ route('dashboard.patient.reservation.action') }}">
                                    <input class="form-control" name="makeReservation" type="text"
                                        value="{{ $user->id }}" hidden required>
                                    <button class="btn btn-primary mb-3 mt-3 shadow rounded float-end"
                                        href="{{ route('dashboard-patient-reservation') }}"><i class="bi bi-calendar2-plus"
                                            style="padding-right: 10px"></i>Buat Reservasi</button>
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
                                    {{-- <th scope="col">NIM</th> --}}
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
                                @foreach ($dataReservation as $data)
                                    <tr>
                                        {{-- <th scope="row"><a class="text-primary">{{ $user->pasien->nim }}</a></th> --}}
                                        <td>{{ $user->name }}</td>
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

                                        @if (isset($data->doctor_id))
                                            <td><a class="text-primary">{{ $data->doctor->user->name }}</a></td>
                                        @else
                                            <td><i class="bi bi-dash-lg"></i><i class="bi bi-dash-lg"></i><i
                                                    class="bi bi-dash-lg"></i></td>
                                        @endif

                                        <td>{{ $data->speciality }}</td>

                                        @if (isset($data->doctor_id))
                                            @if (strtotime($data->date . ' ' . $data->time . ':00') < strtotime(now()))
                                                <td><span class="badge bg-secondary shadow rounded">Completed</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger shadow rounded"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        disabled><i class="bi bi-x-circle"
                                                            style="padding-right: 10px"></i>Batal</button>
                                                </td>
                                            @else
                                                @if (($data->time == '8' or $data->time == '9') and isset($data->doctor_id))
                                                    <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                                @else
                                                    <td><span class="badge bg-warning shadow rounded">Pending</span></td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-sm btn-danger shadow rounded"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        disabled><i class="bi bi-x-circle"
                                                            style="padding-right: 10px"></i>Batal</button>
                                                </td>
                                            @endif
                                        @else
                                            @if (strtotime($data->date . ' ' . $data->time . ':00') < strtotime(now()))
                                                <td><span class="badge bg-danger shadow rounded">Rejected</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger shadow rounded"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        disabled><i class="bi bi-x-circle"
                                                            style="padding-right: 10px"></i>Batal</button>
                                                </td>
                                            @else
                                                @if (($data->time == '8' or $data->time == '9') and isset($data->doctor_id))
                                                    <td><span class="badge bg-success shadow rounded">Approved</span></td>
                                                @else
                                                    <td><span class="badge bg-warning shadow rounded">Pending</span></td>
                                                @endif
                                                <td>
                                                    <form id="formHapus{{ $loop->iteration }}" method="POST"
                                                        action="{{ route('dashboard.patient.reservation.action') }}">
                                                        @csrf
                                                        <input class="form-control" name="hapusID" type="hidden"
                                                            value="{{ $data->id }}" hidden hidden required>
                                                        <a class="btn btn-sm btn-danger shadow rounded"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            onclick="document.getElementById('formHapus{{ $loop->iteration }}').submit()"><i
                                                                class="bi bi-x-circle"
                                                                style="padding-right: 10px"></i>Batal</a>
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
        <!-- ======= End Reservasi Pasien ======= -->

    @endsection
@endif
