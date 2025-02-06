@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6x">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $magang }}</h3>
              <p>Peserta Magang</p>
            </div>
            <div class="icon">
              <i class="fas fa-school "></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{ $tamu }}</h3>
              <p>Tamu</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $narasumber }}</h3>
              <p>Narasumber</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-check"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $acara }}</h3>
              <p>Acara</p>
            </div>
            <div class="icon">
              <i class="fas fa-calendar-check"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
