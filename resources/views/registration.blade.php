@section('title', 'Registrasi Pasien')

@extends('_app')

@section('header')
    <!-- Vendor CSS Files -->
    {{-- <link href="assets_NADM/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.snow.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.bubble.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/remixicon/remixicon.css" rel="stylesheet"> --}}
    <link href="assets_NADM/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet"
        integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css" rel="stylesheet"
        integrity="sha512-XMxqcAfuPHOh2Kz0Z3oDynUcLgyKP6B1NCKUTxyVbM02u1ZrygDcLddKw7KpN/SGmdw8raHbKgaIHP7+bEfGYw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.bubble.css" rel="stylesheet"
        integrity="sha512-mLecVYo2QWbbYIF2u/ppRT91u615n044kBhrGzqbKQRRQxBUj8BR5b+z9qQsUNyWVYr8Z+c/TISuI7cnbpqpWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.3.0/remixicon.css" rel="stylesheet"
        integrity="sha512-0JEaZ1BDR+FsrPtq5Ap9o05MUwn8lKs2GiCcRVdOH0qDcUcCoMKi8fDVJ9gnG8VN1Mp/vuWw2sMO0SQom5th4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS File -->
    <link href="assets_NADM/css/style.css" rel="stylesheet">
@endsection

@section('style')
    <!-- Menghilangkan Tombol Mata Bawaan pada Inputan Password -->
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        input[type="password"]::-moz-reveal {
            display: none;
        }
    </style>
@endsection

@section('content')
    <!-- ======= Registrasi Box ======= -->
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-3">
                            <a class="logo d-flex align-items-center w-auto" href="{{ route('home') }}">
                                <img src="{{ asset('favicon.ico') }}" alt="">
                                <span class="d-none d-lg-block">TelkomSehat</span>
                            </a>
                        </div>

                        <div class="card mb-5 shadow rounded">
                            <div class="card-body">
                                <div class="pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Registrasi Pasien</h5>
                                    <p class="text-center small">Silahkan isi data pasien untuk melakukan registrasi</p>
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

                                @if (session('gagal'))
                                    <div class="alert alert-danger">
                                        {{ session('gagal') }}
                                    </div>
                                @endif

                                <form class="row g-3 needs-validation" method="POST"
                                    action="{{ route('registration.patient.action') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label class="form-label" for="nama">Nama Lengkap</label>
                                        <input class="form-control" id="nama" name="nama" type="text"
                                            placeholder="Nama Lengkap" required>
                                        <div class="invalid-feedback">Masukkan Nama Lengkap.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="text"
                                            placeholder="Email" required>
                                        <div class="invalid-feedback">Masukkan Email.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="username">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <i class="bi bi-at"></i></span>
                                            <input class="form-control" id="username" name="username" type="text"
                                                placeholder="Username" required>
                                            <div class="invalid-feedback">Masukkan Username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="no_hp">Nomor HP</label>
                                        <input class="form-control" id="no_hp" name="no_hp" type="text"
                                            placeholder="Nomor HP" required>
                                        <div class="invalid-feedback">Masukkan Nomor HP.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input class="form-control" id="password-input1" name="password"
                                                type="password" placeholder="Password" required>
                                            <button class="input-group-text" id="show-password-btn1" type="button"><i
                                                    class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Masukkan Password.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input class="form-control" id="password-input2" name="password_confirmation"
                                                type="password" placeholder="Konfirmasi Password" required>
                                            <button class="input-group-text" id="show-password-btn2" type="button"><i
                                                    class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Masukkan Konfirmasi Password.</div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <button class="btn btn-primary w-100 rounded" type="submit">Registrasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="credits text-center">
                            <div class="copyright">
                                Copyright &copy; 2023 <strong><span>TelkomSehat</span></strong> — All Rights Reserved
                            </div>
                            <div class="credits">
                                {{-- Designed by <a href="{{ url()->current() }}">YoNdakTauKokTanyaSaya</a> --}}
                                Designed by
                                <a href="https://github.com/ramhaidar/TelkomSehat_Laravel_10.6.2/graphs/contributors">
                                    SriPandita Team&trade;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ======= End Registrasi Box ======= -->

    <!-- ======= Arrow Up Button ======= -->
    <a class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- ======= End Arrow Up Button ======= -->
@endsection

@section('bottomScript')
    <!-- Script Untuk Tombol Reveal Password -->
    <script>
        const showPasswordBtn1 = document.getElementById('show-password-btn1');
        const passwordInput1 = document.getElementById('password-input1');
        const eyeIcon1 = showPasswordBtn1.querySelector('i');

        showPasswordBtn1.addEventListener('click', () => {
            if (passwordInput1.type === 'password') {
                passwordInput1.type = 'text';
                eyeIcon1.classList.remove('bi-eye');
                eyeIcon1.classList.add('bi-eye-slash');
            } else {
                passwordInput1.type = 'password';
                eyeIcon1.classList.remove('bi-eye-slash');
                eyeIcon1.classList.add('bi-eye');
            }
        });
    </script>

    <script>
        const showPasswordBtn2 = document.getElementById('show-password-btn2');
        const passwordInput2 = document.getElementById('password-input2');
        const eyeIcon2 = showPasswordBtn2.querySelector('i');

        showPasswordBtn2.addEventListener('click', () => {
            if (passwordInput2.type === 'password') {
                passwordInput2.type = 'text';
                eyeIcon2.classList.remove('bi-eye');
                eyeIcon2.classList.add('bi-eye-slash');
            } else {
                passwordInput2.type = 'password';
                eyeIcon2.classList.remove('bi-eye-slash');
                eyeIcon2.classList.add('bi-eye');
            }
        });
    </script>
@endsection
