@section('title', 'Login')

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

    <!-- Template Main CSS File -->
    <link href="assets_NADM/css/style.css" rel="stylesheet">
@endsection

@section('style')
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
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your Username & Password to login</p>
                                </div>

                                <form method="POST" action="{{ route('login.action') }}" class="row g-3 needs-validation">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Username" required>
                                            <div class="invalid-feedback">Please enter your Username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            {{-- <input type="password" name="password" class="form-control" id="yourPassword" required>
                                                <span class="input-group-text" id="inputGroupPrepend">@</span> --}}

                                            <input type="password" class="form-control" placeholder="Password" id="password-input" required name="password">
                                            <button type="button" class="input-group-text" id="show-password-btn"><i class="bi bi-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">Please enter your Password!</div>
                                    </div>

                                    <script>
                                        const showPasswordBtn = document.getElementById('show-password-btn');
                                        const passwordInput = document.getElementById('password-input');
                                        const eyeIcon = showPasswordBtn.querySelector('i');

                                        showPasswordBtn.addEventListener('click', () => {
                                            if (passwordInput.type === 'password') {
                                                passwordInput.type = 'text';
                                                //showPasswordBtn.textContent = '<i class="bi bi-eye"></i>';
                                                eyeIcon.classList.remove('bi-eye');
                                                eyeIcon.classList.add('bi-eye-slash');
                                            } else {
                                                passwordInput.type = 'password';
                                                //showPasswordBtn.textContent = '<i class="bi bi-eye"></i>';
                                                eyeIcon.classList.remove('bi-eye-slash');
                                                eyeIcon.classList.add('bi-eye');
                                            }
                                        });
                                    </script>

                                    <div class="col-12">
                                        {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div> --}}
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    {{-- <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                                        </div> --}}
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="https://telkomsehat.com/">YoNdakTauKokTanyaSaya</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets_NADM/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets_NADM/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_NADM/vendor/chart.js/chart.umd.js"></script>
    <script src="assets_NADM/vendor/echarts/echarts.min.js"></script>
    <script src="assets_NADM/vendor/quill/quill.min.js"></script>
    <script src="assets_NADM/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets_NADM/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets_NADM/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets_NADM/js/main.js"></script>
@endsection
