<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>TVRI e-Guest | {{ $title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('img/eguest_kalsel.png') }}" rel="icon">
  <link href="{{ asset('img/eguest_kalsel.png') }}" rel="apple-touch-icon">

  <link href="{{ asset('free_user_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>

<body class="p-4" style="background-image: url('{{ asset('img/login_bg_2.jpg') }}'); background-size: cover">

  @yield('content')

  @include('sweetalert::alert')

  @yield('script')
  <script src="{{ asset('free_user_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
