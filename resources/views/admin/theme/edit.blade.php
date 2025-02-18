@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      <div class="mb-2">
        <a href="{{ route('theme.index') }}" class="btn btn-secondary">Kembali</a>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-xs">
          <p style="margin-bottom: 2px;">Terjadi kesalahan!</p>
          <ul style="margin: 0;">
            @foreach ($errors->all() as $error)
              <li style="margin-bottom: 3px;">{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="mb-3">Logo</h6>
          <div class="mb-3 text-center">
            <div class="d-inline-block mr-4">
              <h6 class="d-block mb-1">Original</h6>
              <img src="{{ asset('storage/logo/' . $theme->logo) }}" class="img-fluid rounded shadow bg-primary"
                alt="Original Logo" style="max-height: 200px;">
            </div>
            <div class="d-inline-block">
              <h6 class="d-block mb-1">Preview</h6>
              <img id="logoPreview" src="{{ asset('img/default.jpg') }}" class="img-fluid rounded shadow bg-secondary"
                alt="Edited Logo" style="max-height: 200px;">
            </div>
          </div>
          <label for="logo" class="form-label">Pilih Logo</label>
          <form action="{{ route('theme.logo', $theme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="custom-file">
              <input type="file" class="custom-file-input @error('logo')
								is-invalid
							@enderror"
                id="logo" name="logo" onchange="previewLogo(event); updateFileName(this)">
              <label class="custom-file-label" for="logo" id="logoLabel">Choose file</label>
              <small class="text-xs text-muted">* Pastikan background sudah dihapus!</small>
            </div>
            <button class="btn btn-primary mt-3 btn-sm" type="submit">Simpan Perubahan</button>
          </form>
        </div>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h6 class="mb-3">Background</h6>
          <div class="mb-3 text-center">
            <div class="d-inline-block mr-4">
              <h6 class="d-block mb-1">Original</h6>
              <img src="{{ asset('storage/background/' . $theme->background_image) }}" class="img-fluid rounded shadow"
                alt="Original Logo" style="max-height: 200px;">
            </div>
            <div class="d-inline-block mr-4">
              <h6 class="d-block mb-1">Preview</h6>
              <img id="backgroundPreview" src="{{ asset('img/default.jpg') }}" class="img-fluid rounded shadow"
                alt="Background Preview" style="max-height: 200px;">
            </div>
          </div>
          <label for="background" class="form-label">Pilih <i>Background</i></label>
          <form action="{{ route('theme.background', $theme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="custom-file">
              <input type="file"
                class="custom-file-input @error('background_image')
								is-invalid
							@enderror" id="background"
                name="background_image" onchange="previewBackground(event); updateFileName(this)">
              <label class="custom-file-label" for="background" id="backgroundLabel">Choose file</label>
              <small class="text-xs text-muted">* Pastikan kualitas gambar baik (tidak blur atau pecah)!</small>
            </div>
            <button class="btn btn-primary mt-3 btn-sm" type="submit">Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script>
    function previewBackground(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const output = document.getElementById('backgroundPreview');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function previewLogo(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const output = document.getElementById('logoPreview');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function updateFileName(input) {
      const label = input.nextElementSibling;
      if (input.files.length > 0) {
        label.innerText = input.files[0].name;
      } else {
        label.innerText = 'Choose file';
      }
    }
  </script>
@endsection
