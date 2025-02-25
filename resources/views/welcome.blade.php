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
  <link href="{{ asset('free_user_assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">

  <link href="{{ asset('free_user_assets/assets/css/main.css') }}" rel="stylesheet">

  <style>
    html,
    body {
      overflow: hidden;
    }

    @media (max-width: 768px) {
      .d-flex.mt-4 {
        flex-direction: column;
      }
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-lg position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ $theme->logo ? asset('storage/logo/' . $theme->logo) : asset('img/eguest_kalsel.png') }}"
          alt="Logo TVRI" class="me-2" style="height: 40px;">
        <h1 class="sitename mb-0">TVRI e-Guest</h1>


        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="" data-bs-toggle="modal" data-bs-target="#creditModal">Credit</a></li>
            <li><a href="{{ route('login') }}">Admin</a></li>
          </ul>
          <i class="mobile-nav-toggle d-lg-none fas fa-bars "></i>
        </nav>
    </div>
  </header>

  <main class="main">
    <section class="hero section dark-background">
      <img
        src="{{ $theme->background_image ? asset('storage/background/' . $theme->background_image) : asset('img/login_bg_2.jpg') }}"
        alt="{{ $theme->background_image }}" />

      @include('sweetalert::alert')
      <div class="container d-flex flex-column align-items-center text-center">
        <h2 data-aos="fade-up" data-aos-delay="100">
          SELAMAT DATANG DI TVRI KALIMANTAN SELATAN
        </h2>
        <p data-aos="fade-up" data-aos-delay="200">
          Silahkan pilih menu di bawah ini
        </p>
        <div class="d-flex mt-4 gap-3 flex-column flex-md-row justify-content-center" data-aos="fade-up"
          data-aos-delay="300">
          <a href="{{ route('narasumber') }}"
            class="btn btn-lg btn-primary w-100 w-md-auto text-uppercase">Narasumber</a>
          <a href="{{ route('magang') }}" class="btn btn-lg btn-danger w-100 w-md-auto text-uppercase">Magang</a>
          <a href="{{ route('tamu') }}" class="btn btn-lg btn-secondary w-100 w-md-auto text-uppercase">Tamu</a>
        </div>
      </div>
    </section>

  </main>

  {{-- modal  --}}
  <!-- Modal -->
  <div class="modal fade text-center" id="creditModal" tabindex="-1" aria-labelledby="creditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="creditModalLabel">Credit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-3">
            <div class="card-body">
              <h5>Executive Producer</h5>
              Tuhan YME
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>Project Leader</h5>
              This is some text within a card body.
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>System Analyst</h5>
              This is some text within a card body.
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>Project Manager</h5>
              Kamal Rahmi
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>Lead Programmer</h5>
              Kamal Rahmi
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>Programmer</h5>
              This is some text within a card body.
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5>Interface Designer</h5>
              This is some text within a card body.
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="fas fa-arrow-up"></i></a>

  <script src="{{ asset('free_user_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('free_user_assets/assets/vendor/aos/aos.js') }}"></script>

  <script src="{{ asset('free_user_assets/assets/js/main.js') }}"></script>

</body>

</html>
