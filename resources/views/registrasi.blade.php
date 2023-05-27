@section('title', 'Registrasi Pasien')

@extends('app')

@section('header')
    <!-- Vendor CSS Files -->
    <link href="assets_NADM/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_NADM/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_NADM/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_NADM/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets_NADM/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets_NADM/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_NADM/vendor/simple-datatables/style.css" rel="stylesheet">

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
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ route('beranda') }}" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('favicon.ico') }}" alt="">
                                <span class="d-none d-lg-block">TelkomSehat</span>
                            </a>
                        </div>

                        <div class="card mb-3 shadow rounded">
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

                                <form method="POST" action="{{ route('registrasi.pasien.action') }}"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="col-12">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            placeholder="Nama Lengkap" required>
                                        <div class="invalid-feedback">Masukkan Nama Lengkap.</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="email"
                                            placeholder="Email" required>
                                        <div class="invalid-feedback">Masukkan Email.</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <i class="bi bi-at"></i></span>
                                            <input type="text" name="username" class="form-control" id="username"
                                                placeholder="Username" required>
                                            <div class="invalid-feedback">Masukkan Username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="no_hp" class="form-label">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp"
                                            placeholder="Nomor HP" required>
                                        <div class="invalid-feedback">Masukkan Nomor HP.</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="password-input1" required name="password">
                                            <button type="button" class="input-group-text" id="show-password-btn1"><i
                                                    class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Masukkan Password.</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Konfirmasi Password"
                                                id="password-input2" required name="password_confirmation">
                                            <button type="button" class="input-group-text" id="show-password-btn2"><i
                                                    class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Masukkan Konfirmasi Password.</div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <button class="btn btn-primary w-100 shadow rounded"
                                            type="submit">Registrasi</button>
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
