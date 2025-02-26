<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Cetak Data Magang</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .date-range {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      table-layout: auto;
    }

    table,
    th,
    td {
      border: 1px solid #000;
      text-align: center;
    }

    th,
    td {
      padding: 8px;
      word-wrap: break-word;
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

  <h1>Data Peserta Magang</h1>

  <p class="date-range">Rentang Tanggal: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
    {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Institusi</th>
        <th>TTL</th>
        <th>Durasi Magang</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($interns as $index => $intern)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $intern->name }}</td>
          <td>{{ $intern->gender == 'laki_laki' ? 'Laki-Laki' : 'Perempuan' }}</td>
          <td>{{ $intern->institution }}</td>
          <td>{{ $intern->birthplace }},
            {{ \Carbon\Carbon::parse($intern->date_of_birth)->locale('id')->format('d F Y') }}
          </td>
          <td>
            {{ \Carbon\Carbon::parse($intern->start)->locale('id')->format('d F Y') }} -
            {{ \Carbon\Carbon::parse($intern->end)->locale('id')->format('d F Y') }}
            ({{ round(\Carbon\Carbon::parse($intern->start)->diffInMonths(\Carbon\Carbon::parse($intern->end))) }}
            bulan)
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
