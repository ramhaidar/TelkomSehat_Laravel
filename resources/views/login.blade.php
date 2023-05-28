@section('title', 'Login')

@extends('app')

@section('header')
    <!-- Vendor CSS Files -->
    {{-- <link href="assets_NADM/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.snow.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/quill/quill.bubble.css" rel="stylesheet"> --}}
    {{-- <link href="assets_NADM/vendor/remixicon/remixicon.css" rel="stylesheet"> --}}
    <link href="assets_NADM/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css"
        integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css"
        integrity="sha512-XMxqcAfuPHOh2Kz0Z3oDynUcLgyKP6B1NCKUTxyVbM02u1ZrygDcLddKw7KpN/SGmdw8raHbKgaIHP7+bEfGYw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.bubble.css"
        integrity="sha512-mLecVYo2QWbbYIF2u/ppRT91u615n044kBhrGzqbKQRRQxBUj8BR5b+z9qQsUNyWVYr8Z+c/TISuI7cnbpqpWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.3.0/remixicon.css"
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
    <!-- ======= Login Box ======= -->
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-3">
                            <a href="{{ route('beranda') }}" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('favicon.ico') }}" alt="">
                                <span class="d-none d-lg-block">TelkomSehat</span>
                            </a>
                        </div>

                        <div class="card mb-5 shadow rounded">
                            <div class="card-body">
                                <div class="pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun Anda</h5>
                                    <p class="text-center small">Masukkan Username & Password Anda untuk masuk</p>
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

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login.action') }}" class="row g-3 needs-validation">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="bi bi-at"></i></span>
                                            <input type="text" name="username" class="form-control" id="yourUsername"
                                                placeholder="Username" required>
                                            <div class="invalid-feedback">Masukkan Username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="password-input" required name="password">
                                            <button type="button" class="input-group-text" id="show-password-btn"><i
                                                    class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Masukkan Password.</div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <button class="btn btn-primary w-100 rounded" type="submit">Login</button>
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
    <!-- ======= End Login Box ======= -->

    <!-- ======= Arrow Up Button ======= -->
    <a class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- ======= End Arrow Up Button ======= -->
@endsection

@section('bottomScript')
    <!-- Script Untuk Tombol Reveal Password -->
    <script>
        const showPasswordBtn = document.getElementById('show-password-btn');
        const passwordInput = document.getElementById('password-input');
        const eyeIcon = showPasswordBtn.querySelector('i');

        showPasswordBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });
    </script>
@endsection
