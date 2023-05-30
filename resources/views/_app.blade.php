<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TelkomSehat | @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="{{ asset('favicon.ico') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    {{-- <link href="{{ asset('google_fonts/fonts_googleapis.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- font-family: 'Open Sans', sans-serif;
    font-family: 'Play', sans-serif;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif; --}}

    <!-- Bootstrap 5.3 -->
    {{-- <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Icon Bootstrap v1.10.4 | 13 April 2023-->
    {{-- <link rel="stylesheet" href="{{ asset('icon_bootstrap/bootstrap-icons.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
