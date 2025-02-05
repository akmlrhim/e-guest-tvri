@extends('layouts.admin.main')

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.magang.update', $intern->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="name" class="form-label">Nama</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="name" name="name"
                  class="form-control form-control-sm @error('name') is-invalid @enderror" autocomplete="off" autofocus
                  placeholder="Masukkan Nama" value="{{ old('name', $intern->name) }}" />
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label class="form-label">Jenis Kelamin</label>
              </div>
              <div class="col-sm-9 d-flex align-items-center">
                <div class="form-check form-check-inline">
                  <input type="radio" id="laki_laki" name="gender" value="laki_laki"
                    class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                    {{ $intern->gender == 'laki_laki' ? 'checked' : '' }} />
                  <label for="laki_laki" class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="perempuan" name="gender" value="perempuan"
                    class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                    {{ $intern->gender == 'perempuan' ? 'checked' : '' }} />
                  <label for="perempuan" class="form-check-label">Perempuan</label>
                </div>
                @error('gender')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="institusi" class="form-label">Asal Sekolah/institusi</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="institusi"
                  class="form-control form-control-sm @error('institution') is-invalid @enderror" name="institution"
                  value="{{ old('institution', $intern->institution) }}" autocomplete="off"
                  placeholder="Masukkan Asal Sekolah" />

                @error('institution')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="birthplace">TTL</label>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm @error('birthplace') is-invalid	@enderror"
                  value="{{ old('birthplace', $intern->birthplace) }}" id="birthplace" name="birthplace"
                  placeholder="Tempat Lahir" autocomplete="off" onfocus="this.showPicker()">
                <small class="text-primary">Tempat Lahir</small><br>
                @error('birthplace')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                  value="{{ old('date_of_birth', $intern->date_of_birth) }}" id="date_of_birth" name="date_of_birth"
                  autocomplete="off" onfocus="this.showPicker()">
                <small class="text-primary ">Tanggal Lahir</small><br>
                @error('date_of_birth')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label" for="start">Durasi Magang </label>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('start') is-invalid @enderror"
                  id="start" value="{{ old('start', $intern->start) }}" name="start" autocomplete="off"
                  onfocus="this.showPicker()" />
                <small class="text-primary">Mulai Magang</small><br>
                @error('start')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('end') is-invalid @enderror"
                  id="end" name="end" value="{{ old('end', $intern->end) }}" autocomplete="off"
                  onfocus="this.showPicker()" />
                <small class="text-primary">Selesai Magang</small><br>
                @error('end')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="phone_number" class="form-label">Nomor HP</label>
              </div>
              <div class="col-sm-9">
                <input type="text" inputmode="numeric" id="phone_number"
                  class="form-control form-control-sm @error('phone_number') is-invalid @enderror" autocomplete="off"
                  name="phone_number" value="{{ old('phone_number', $intern->phone_number) }}"
                  placeholder="Masukkan Nomor HP" />

                @error('phone_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="email" class="form-label">Email</label>
              </div>
              <div class="col-sm-9">
                <input type="email" id="email" name="email"
                  class="form-control form-control-sm @error('email') is-invalid @enderror" autocomplete="off"
                  placeholder="Masukkan Email" value="{{ old('email', $intern->email) }}" />
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="address" class="form-label">Alamat Rumah</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="address" name="address"
                  class="form-control form-control-sm @error('address') is-invalid
									@enderror"
                  placeholder="Masukkan Alamat" value="{{ old('address', $intern->address) }}" autocomplete="off" />
                @error('address')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="parent_number" class="form-label">Nomor HP Orang Tua</label>
              </div>
              <div class="col-sm-9">
                <input type="text" inputmode="numeric" id="parent_number"
                  class="form-control form-control-sm @error('parent_number') is-invalid
									@enderror"
                  autocomplete="off" name="parent_number" value="{{ old('parent_number', $intern->parent_number) }}"
                  placeholder="Masukkan Nomor HP Orang Tua" />
                @error('parent_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="mt-3">
              <a class="btn btn-secondary" href="{{ route('admin.magang') }}">
                Kembali
              </a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
