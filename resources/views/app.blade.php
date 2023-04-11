<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TelkomSehat | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="{{ asset('favicon.ico') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Icon Bootstrap v1.10.4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    @yield('header')

    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            alert("Ukuran layar Anda terlalu kecil untuk mengakses situs web ini. Silakan perlebar ukuran web browser anda atau gunakan desktop mode. Tekan Ok untuk Reload");
            location.reload();
        }

        // if (window.innerWidth < 1464 || window.innerHeight < 949) {
        // if (window.innerWidth < 1280 || window.innerHeight < 648) {
        // if (window.innerWidth < 1360 || window.innerHeight < 610) {
        if (window.innerWidth < 1270 || window.innerHeight < 610) {
            alert("Ukuran layar Anda terlalu kecil untuk mengakses situs web ini. Silakan perlebar ukuran web browser anda atau gunakan desktop mode. Tekan Ok untuk Reload");
            location.reload();
        }
    </script>

    @yield('script')

    @yield('style')
</head>

<body>

    @yield('content')

</body>

</html>
