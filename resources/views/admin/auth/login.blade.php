<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-Guest TVRI | Login</title>
  <link rel="icon" type="image/png" href="{{ asset('img/eguest_kalsel.png') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/login.css') }}">

</head>


<body>

  @include('sweetalert::alert')

  <div id="card">
    <div class="navItems">
      <ul>
        <li>Login</li>
      </ul>
    </div>
    <div class="content">
      <!-- Login Form -->
      <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <!-- Username Field -->
        <label for="email" autofocus>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" autocomplete="off"
          class="form-control @error('email') is-invalid @enderror" />

        @error('email')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror

        <!-- Password Field -->
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="********"
          class="form-control @error('password') is-invalid @enderror" />

        @error('password')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror

        <!-- Sign in Button -->
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </form>
    </div>


    <div class="footer">
      <p>&copy; E-Guest TVRI Kalimantan Selatan 2025</p>
      <a href="{{ route('home') }}"
        style="color: gray; font-size: 12px; text-decoration: none; justify-content: center">Kembali?</a>
    </div>
  </div>

  <div class="clear"></div>

</body>

</html>
