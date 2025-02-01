@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      {{-- data  --}}
      <div class="card">
        <div class="card-body">
          <form action="{{ route('program.store') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="name">Nama Acara</label>
              <input type="text" class="form-control @error('program_name')
								is-invalid
							@enderror"
                id="name" name="program_name" placeholder="Masukkan Nama Acara" autofocus
                value="{{ old('program_name') }}" autocomplete="off">
              @error('program_name')
                <small class="invalid-feedback d-block">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Pilih Hari Tayang</label>
              <div>
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                  <div class="form-check">
                    <input class="form-check-input @error('days')
											is-invalid
										@enderror"
                      type="checkbox" name="days[]" id="{{ strtolower($day) }}" value="{{ $day }}">
                    <label class="form-check-label" for="{{ strtolower($day) }}">{{ $day }}</label>
                  </div>
                @endforeach
              </div>
              @error('days')
                <small class="invalid-feedback d-block">{{ $message }}</small>
              @enderror
            </div>


            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jam Tayang Acara</label>
              <div class="col-sm-5">
                <input type="time" class="form-control @error('start_time')
									is-invalid
								@enderror"
                  id="start_time" name="start_time" placeholder="Jam Mulai" value="{{ old('start_time') }}"
                  onfocus="this.showPicker()">
                <small class="form-text text-muted">Jam Mulai</small>
                @error('start_time')
                  <small class="invalid-feedback d-block">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-sm-5">
                <input type="time" class="form-control @error('end_time')
									is-invalid
								@enderror"
                  id="end_time" name="end_time" placeholder="Tanggal Surat" autocomplete="off"
                  value="{{ old('end_time') }}" onfocus="this.showPicker()">
                <small class="form-text text-muted">Jam Berakhir</small>
                @error('end_time')
                  <small class="invalid-feedback d-block">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="mt-3">
              <a class="btn btn-secondary" href="{{ route('program') }}">
                Kembali
              </a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
