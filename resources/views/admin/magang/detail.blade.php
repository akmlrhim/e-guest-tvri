@extends('layouts.admin.main')

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Nama</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" disabled value="{{ $intern->name }}" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Jenis Kelamin</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" disabled
                value="{{ $intern->gender == 'laki_laki' ? 'Laki-laki' : 'Perempuan' }}" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Asal sekolah/institusi</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" disabled value="{{ $intern->institution }}" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">TTL</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" disabled
                value="{{ $intern->birthplace }}, {{ \Carbon\Carbon::parse($intern->date_of_birth)->locale('id')->translatedFormat('d F Y') }}" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Durasi Magang</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" disabled
                value="{{ \Carbon\Carbon::parse($intern->start_date)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($intern->end_date)->locale('id')->translatedFormat('d F Y') }}" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Nomor HP</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" value="{{ $intern->phone_number }}"
                placeholder="Masukkan Nomor HP" disabled />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Email</label>
            </div>
            <div class="col-sm-9">
              <input class="form-control form-control-sm" value="{{ $intern->email }}" disabled />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Alamat Rumah</label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm" value="{{ $intern->address }}" disabled />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-3">
              <label class="form-label">Nomor HP Orang Tua</label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm" value="{{ $intern->parent_number }}" disabled />
            </div>
          </div>

          <div class="mt-3">
            <a class="btn btn-secondary" href="{{ route('admin.magang') }}">
              Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
