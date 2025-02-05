@extends('layouts.admin.main')

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.narasumber.update', $speaker->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="name" class="form-label">Nama</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="name" name="name"
                  class="form-control form-control-sm @error('name') is-invalid @enderror" autocomplete="off" autofocus
                  placeholder="Masukkan Nama" value="{{ old('name', $speaker->name) }}" />
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
                    {{ $speaker->gender == 'laki_laki' ? 'checked' : '' }} />
                  <label for="laki_laki" class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" id="perempuan" name="gender" value="perempuan"
                    class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                    {{ $speaker->gender == 'perempuan' ? 'checked' : '' }} />
                  <label for="perempuan" class="form-check-label">Perempuan</label>
                </div>
                @error('gender')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="origin" class="form-label">Asal</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="origin"
                  class="form-control form-control-sm @error('origin') is-invalid @enderror" name="origin"
                  value="{{ old('origin', $speaker->origin) }}" autocomplete="off" placeholder="Masukkan Asal" />
                @error('origin')
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
                  placeholder="Masukkan Email" value="{{ old('email', $speaker->email) }}" />
                @error('email')
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
                  name="phone_number" value="{{ old('phone_number', $speaker->phone_number) }}"
                  placeholder="Masukkan Nomor HP" />

                @error('phone_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="date_of_visit" class="form-label">Tanggal Kunjungan</label>
              </div>
              <div class="col-sm-9">
                <input type="date" id="date_of_visit" class="form-control @error('date_of_visit') is-invalid @enderror"
                  name="date_of_visit" value="{{ old('date_of_visit', $speaker->date_of_visit) }}" autocomplete="off"
                  onfocus="this.showPicker()" />

                @error('date_of_visit')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="program" class="form-label">Acara</label>
              </div>
              <div class="col-sm-9">
                <select name="program_id" class="form-select form-control form-control-sm" id="program">
                  <option value="" selected>-- Pilih Acara --</option>
                  @foreach ($program as $row)
                    <option value="{{ $row->id }}"
                      {{ old('program_id', $speaker->program_id ?? '') == $row->id ? 'selected' : '' }}>
                      {{ $row->program_name }}
                    </option>
                  @endforeach
                </select>

                @error('program_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>



            <div class="mt-3">
              <a class="btn btn-secondary" href="{{ route('admin.narasumber') }}">
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
