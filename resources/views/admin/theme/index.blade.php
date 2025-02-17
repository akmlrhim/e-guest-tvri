@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      @if (!$theme)
        <div class="mb-4">
          <a href="{{ route('theme.edit', $theme->id) }}" class="btn btn-primary">Edit Logo/Background ?</a>
        </div>
      @endif


      <div class="mb-4">
        <a href="{{ route('theme.edit', $theme->id) }}" class="btn btn-primary">Edit Logo/Background</a>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="mb-3">Logo</h6>
          <div class="mb-3 text-center">
            <img src="{{ $theme->logo ? asset('storage/logo/' . $theme->logo) : asset('img/eguest_kalsel.png') }}"
              class="img-fluid rounded shadow bg-primary" alt="Background Preview" style="max-height: 200px;">
          </div>
        </div>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="mb-3">Home Preview</h6>
          <div class="mb-3 text-center">
            <iframe id="myIframe" src="{{ route('home') }}" style="pointer-events: none; width: 100%; border: none;"
              frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function adjustIframeHeight() {
      var iframe = document.getElementById('myIframe');
      if (iframe.contentWindow.document.body) {
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
      }
    }

    document.getElementById('myIframe').onload = function() {
      setTimeout(adjustIframeHeight, 50);
    };
  </script>
@endsection
