@extends('layouts.free_user.main')

@section('content')
  <div class="container d-flex rounded-5 shadow-lg justify-content-center align-items-center vh-100">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Terima Kasih <b>{{ $intern->name }}</b>, kartu anda telah selesai dibuat.</h5>
        <img src="{{ asset('storage/magang/' . $intern->photo) }}" alt="{{ $intern->name }}"
          class="mx-auto img-thumbnail d-block mb-3" style="width: 240px; height: 300px; object-fit: cover;">
        <div class="row">
          <div class="col-4">
            <a href="{{ route('magang.id.card.print', ['id' => $intern->id]) }}" target="_blank"
              class="btn btn-success w-100"><i class="fas fa-print"></i>&nbsp; Cetak
              Kartu</a>
          </div>
          <div class="col-4">
            <a href="#" onclick="submitForm(event);" class="btn btn-primary w-100" id="submitButton"><i
                class="fas fa-paper-plane"></i>&nbsp; Kirim</a>
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


  <form action="{{ route('magang.finished') }}" method="POST" class="d-none" id="finish-form">
    @csrf
  </form>

  <form action="{{ route('magang.id.card.send', ['id' => $intern->id]) }}" class="d-none" method="POST" id="send-card">
    @csrf
  </form>
@endsection

@section('script')
  <script>
    function submitForm(event) {
      event.preventDefault();
      let button = document.getElementById('submitButton');

      button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
      button.classList.add('disabled');

      document.getElementById('send-card').submit();
    }
  </script>
@endsection
