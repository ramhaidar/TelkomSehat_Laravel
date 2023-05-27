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
    <link href="{{ asset('google_fonts/fonts_googleapis.css') }}" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icon Bootstrap v1.10.4 | 13 April 2023-->
    <link rel="stylesheet" href="{{ asset('icon_bootstrap/bootstrap-icons.css') }}">

    @yield('header')

    <!-- Script Force Screen Size -->
    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            alert(
                "Ukuran layar Anda terlalu kecil untuk mengakses situs web ini. \nSilakan perlebar ukuran web browser anda atau gunakan desktop mode."
                );
            location.reload();
        }

        //if (window.innerWidth < 1270 || window.innerHeight < 610) {
        if (window.innerWidth < window.innerHeight) {
            alert(
                "Ukuran layar Anda terlalu kecil untuk mengakses situs web ini. \nSilakan perlebar ukuran web browser anda atau gunakan desktop mode."
                );
            location.reload();
        }
    </script>

    @yield('script')

    @yield('style')
</head>

<body>

    @yield('content')

    @yield('bottomScript')
    @yield('bottomScriptx')

</body>

</html>
