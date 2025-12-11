<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title', 'ManfaatinOnline.com')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" href="{{ asset('user/images/logom.png') }}">
  <link rel="shortcut icon" href="{{ asset('user/images/logom.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('user/images/logom.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  @stack('styles')
</head>

<body>

  @include('user.partials.header')

  @yield('content')

  @include('user.partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  
  @stack('scripts')

</body>

</html>