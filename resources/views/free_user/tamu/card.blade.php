@extends('layouts.free_user.main')

@section('content')
  <div class="container d-flex rounded-5 shadow-lg justify-content-center align-items-center vh-100">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Terima Kasih <b>{{ $guest->name }}</b>, kartu anda telah selesai dibuat.</h5>
        <img src="{{ asset('storage/tamu/' . $guest->photo) }}" alt="{{ $guest->name }}"
          class="mx-auto img-thumbnail d-block mb-3" style="width: 240px; height: 300px; object-fit: cover;">
        <div class="row">
          <div class="col-4">
            <a href="{{ route('tamu.id.card.print', ['id' => $guest->id]) }}" class="btn btn-success w-100"><i
                class="fas fa-download"></i>&nbsp; Cetak
              Kartu</a>
          </div>
          <div class="col-4">
            <a href="#" onclick="event.preventDefault(); document.getElementById('send-card').submit();"
              class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i>&nbsp; Kirim</a>
          </div>
          <div class="col-4">
            <a href="#" class="btn btn-secondary w-100"
              onclick="event.preventDefault(); document.getElementById('finish-form').submit();"><i
                class="fas fa-check"></i>&nbsp; Selesai</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <form action="{{ route('tamu.finished') }}" method="POST" id="finish-form">
    @csrf
  </form>

  <form action="{{ route('tamu.id.card.send', ['id' => $guest->id]) }}" method="POST" id="send-card">
    @csrf
  </form>
@endsection
