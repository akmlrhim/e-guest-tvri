<div>
  <h3>Record Data</h3>
  <ul>
    <li>Nama Lengkap : {{ $speaker->name }}</li>
    <li>Email : {{ $speaker->email }}</li>
    <li>Asal : {{ $speaker->origin }}</li>
    <li>Jenis Kelamin : {{ $speaker->gender == 'laki_laki' ? 'Laki-Laki' : 'Perempuan' }}</li>
    <li>Nomor HP : {{ $speaker->phone_number }}</li>
    <li>Nama Acara : {{ $speaker->program->program_name }}</li>
    <li>Tanggal Berkunjung :
      {{ \Carbon\Carbon::parse($speaker->date_of_visit)->locale('id')->translatedFormat('d F Y') }}
    </li>
  </ul>
</div>
