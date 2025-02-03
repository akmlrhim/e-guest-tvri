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
  <link href="{{ asset('free_user_assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">


  <link href="{{ asset('free_user_assets/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-lg position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">TVRI e-Guest</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="">Credit</a></li>
          <li><a href="">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-lg-none fas fa-bars "></i>
      </nav>

      <a class="cta-btn" href="{{ route('login') }}">Login Admin</a>

    </div>
  </header>

  <main class="main">
    <section class="hero section dark-background">
      <img src="{{ asset('img/login_bg_2.jpg') }}" alt="" data-aos="fade-in">

      @include('sweetalert::alert')

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">
          SELAMAT DATANG DI TVRI KALIMANTAN SELATAN
        </h2>
        <p data-aos="fade-up" data-aos-delay="200">
          Silahkan pilih menu di bawah ini
        </p>
        <div class="d-flex mt-4 gap-3" data-aos="fade-up" data-aos-delay="300">
          <a href="{{ route('narasumber') }}" class="btn btn-lg btn-primary">Narasumber</a>
          <a href="{{ route('magang') }}" class="btn btn-lg btn-danger">Magang</a>
          <a href="{{ route('tamu') }}" class="btn btn-lg btn-secondary">Tamu</a>
        </div>
      </div>

    </section>

  </main>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="fas fa-arrow-up"></i></a>

  <script src="{{ asset('free_user_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('free_user_assets/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('free_user_assets/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('free_user_assets/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>

  <script src="{{ asset('free_user_assets/assets/js/main.js') }}"></script>

</body>

</html>
