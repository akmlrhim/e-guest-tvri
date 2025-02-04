<div>
  <h3>Record Data</h3>
  <ul>
    <li>Nama Lengkap : {{ $guest->name }}</li>
    <li>Jenis Kelamin : {{ $guest->gender == 'laki_laki' ? 'Laki-Laki' : 'Perempuan' }}</li>
    <li>Asal : {{ $guest->origin }}</li>
    <li>Email : {{ $guest->email }}</li>
    <li>Nomor HP : {{ $guest->phone_number }}</li>
    <li>Keperluan : {{ $guest->objectives }}</li>
  </ul>
</div>
