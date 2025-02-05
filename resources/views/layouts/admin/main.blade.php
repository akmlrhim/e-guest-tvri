<!DOCTYPE html>

<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>E-Guest TVRI | {{ $title }}</title>

  <link rel="shortcut icon" href="{{ asset('img/eguest_kalsel.png') }}" type="image/x-icon">
  <link rel="icon" type="image/png" href="{{ asset('img/eguest_kalsel.png') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

</head>

<body class="sidebar-mini layout-footer-fixed layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    @include('layouts.admin.partials.navbar')

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      @include('layouts.admin.partials.logo')

      <div class="hr"></div>

      @include('layouts.admin.partials.sidebar')

    </aside>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-6">
              <h1 class="m-0 font-weight-bold">{{ $title }}</h1>
            </div>
            <div class="col-md-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      @include('sweetalert::alert')

      @yield('content')

    </div>

    @include('layouts.admin.partials.footer')
  </div>

  <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/adminlte.min.js') }}"></script>

  <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

  @yield('script')

</body>

</html>
