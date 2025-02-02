<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-Guest TVRI | Login</title>
  <link rel="icon" type="image/png" href="{{ asset('img/tvri_logo.png') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">

</head>

<body style="background-image: url('{{ asset('img/login_bg_2.jpg') }}'); background-size: cover"
  class="login-page hold-transition">

  @include('sweetalert::alert')

  <div class="login-box">
    <div class="card card-outline card-primary shadow">
      <div class="card-header text-center">
        <img src="{{ asset('img/tvri_logo_2.png') }}" style="width: 50%" alt="">
      </div>
      <div class="card-body ">
        <p class="login-box-msg font-weight-bold">Sign in to start your session</p>

        <form action="{{ route('login.process') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              placeholder="Email" autocomplete="off" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
              <div class="invalid-feedback d-block">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
              placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
              <div class="invalid-feedback d-block">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="row">
            <div class="col-6">
              <a href="/" class="btn text-primary">Kembali</a>
            </div>

            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</html>
