<div>
  <h3>Record Data</h3>
  <ul>
    <li>Nama Lengkap : {{ $intern->name }}</li>
    <li>Jenis Kelamin : {{ $intern->gender == 'laki_laki' ? 'Laki-Laki' : 'Perempuan' }}</li>
    <li>Asal Sekolah / Institusi : {{ $intern->institution }}</li>
    <li>TTL : {{ $intern->birthplace }}, {{ \Carbon\Carbon::parse($intern->date_of_birth)->translatedFormat('d F Y') }}
    </li>
    <li>Tanggal Mulai Magang : {{ \Carbon\Carbon::parse($intern->start)->translatedFormat('d F Y') }}</li>
    <li>Tanggal Selesai Magang : {{ \Carbon\Carbon::parse($intern->end)->translatedFormat('d F Y') }}</li>
    <li>Email : {{ $intern->email }}</li>
    <li>Nomor HP : {{ $intern->phone_number }}</li>
    <li>Alamat : {{ $intern->address }}</li>
    <li>Nomor HP Orang Tua : {{ $intern->parent_number }}</li>
  </ul>
</div>
