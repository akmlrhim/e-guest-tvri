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
      background-image: url('{{ public_path('img/tamu_card.png') }}');
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
      margin: 0 auto 50px auto;
    }

    .photo img {
      width: 180px;
      height: 180px;
      object-fit: cover;
      margin-top: 190px;
    }

    .details {
      margin-bottom: 100px;
    }

    .compact {
      line-height: 0.6em;
      margin: 5px 0;
    }
  </style>
</head>

<body>
  <div class="id-card">
    <div class="content">
      <div class="photo">
        <img src="{{ public_path('storage/tamu/' . $guest->photo) }}" alt="Foto Profil" />
      </div>
      <div class="details">
        <div style="margin-top: 210px"></div>
        <h3 style="color: white; text-transform: uppercase; font-size: 34px;">
          {{ $guest->name }}
        </h3>
        <h4 class="compact" style="color: white; text-transform: uppercase; font-size: 24px;">{{ $guest->origin }}</h4>
      </div>
    </div>
  </div>


</body>

</html>
