<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ID Card</title>

  <style>
    @font-face {
      font-family: 'GothamPro';
      src: url('{{ storage_path('fonts/GothamPro-Bold.ttf') }}') format('truetype');
      font-weight: bold;
      font-style: bold;
    }

    body {
      font-family: 'GothamPro', sans-serif;
      background-color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin-left: 100px;
    }

    .id-card {
      width: 400px;
      height: 600px;
      position: relative;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      background-image: url('{{ public_path('img/kartu_magang.png') }}');
      background-size: cover;
      background-position: center;
      border: 1px dashed #000000;
    }

    .content {
      padding: 20px;
      text-align: center;
    }

    .photo {
      width: 120px;
      height: 120px;
      border-radius: 10px;
      margin: 0 auto 30px auto;
    }

    .photo img {
      width: 180px;
      height: 180px;
      object-fit: cover;
      margin-top: 115px;
    }

    .details {
      margin-top: 200px;
    }

    .details h3 {
      font-size: 30px;
      text-transform: uppercase;
      color: #ffffff;
      margin-bottom: 10px;
    }

    .details h4 {
      text-transform: uppercase;
      color: #ffffff;
      font-size: 20px;
      margin: 0;
    }

    .details .date {
      text-transform: uppercase;
      color: #ffffff;
      margin-top: 64px;
      padding: 5px 10px;
      font-size: 14px;
      background: #1E3462;
      display: inline-block;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="id-card">
    <div class="content">
      <div class="photo">
        <img src="{{ public_path('storage/magang/' . $intern->photo) }}" alt="Foto Profil" />
      </div>
      <div class="details">
        <h3>{{ $intern->name }}</h3>
        <h4>{{ $intern->institution }}</h4>
        <h4 class="date">
          DURASI MAGANG <br>
          {{ \Carbon\Carbon::parse($intern->start)->format('d-m-Y') }}
          &nbsp; - &nbsp;
          {{ \Carbon\Carbon::parse($intern->end)->format('d-m-Y') }}
        </h4>

      </div>
    </div>
  </div>
</body>

</html>
