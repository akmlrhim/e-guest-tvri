<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Cetak Data Tamu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      table-layout: auto;
      /* Menyesuaikan lebar kolom dengan isi */
    }

    table,
    th,
    td {
      border: 1px solid #000;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      word-wrap: break-word;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .date-range {
      text-align: center;
      margin-bottom: 30px;
    }

    a {
      text-decoration: none;
      color: blue;
    }

    li {
      list-style: none;
    }
  </style>
</head>

<body>

  <h1>Data Tamu</h1>

  <p class="date-range">Rentang Tanggal: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
    {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Data Diri</th>
        <th>Tujuan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($guests as $index => $guest)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $guest->name }} / {{ $guest->gender == 'laki_laki' ? 'L' : 'P' }}
            <li><a href="mailto:{{ $guest->email }}" target="_blank">{{ $guest->email }}</a></li>
            <li><a href="https://wa.me/{{ $guest->phone_number }}" target="_blank">{{ $guest->phone_number }}</a></li>
            <b>
              <li>Asal : {{ $guest->origin }}</li>
            </b>
          </td>

          <td>{{ $guest->objectives }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
