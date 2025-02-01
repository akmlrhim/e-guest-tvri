<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>TVRI e-Guest</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('img/tvri_logo.png') }}" rel="icon">
  <link href="{{ asset('img/tvri_logo.png') }}" rel="apple-touch-icon">

  <link href="{{ asset('free_user_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">

</head>

<body>

  @yield('content')


  <script src="{{ asset('free_user_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
