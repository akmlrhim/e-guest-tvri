@extends('layouts.free_user.main')

@section('content')
  <div class="container d-flex rounded-3 justify-content-center align-items-center vh-100">
    <div class="card w-100 rounded-3" style="max-width: 900px;">
      <div class="card-body text-left">
        <h3 class="text-primary mb-3 fw-bold">NARASUMBER</h3>
        <form id="multiStepForm" action="{{ route('narasumber.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="step" id="step1">
            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="name" class="form-label">Nama</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="name" name="name"
                  class="form-control @error('name') is-invalid @enderror" autocomplete="off" autofocus
                  placeholder="Masukkan Nama" value="{{ old('name') }}" />
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
              </div>
              <div class="col-sm-4">
                <input type="radio" id="laki_laki" name="gender" value="laki_laki"
                  class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                  {{ old('gender') == 'laki_laki' ? 'checked' : '' }} />
                <label for="laki_laki" class="form-check-label">Laki-laki</label> <br>
                @error('gender')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-4">
                <input type="radio" id="perempuan" name="gender" value="perempuan"
                  class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                  {{ old('gender') == 'perempuan' ? 'checked' : '' }} />
                <label for="perempuan" class="form-check-label">Perempuan</label>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="origin" class="form-label">Asal</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="origin" name="origin"
                  class="form-control @error('origin') is-invalid @enderror" autocomplete="off" autofocus
                  placeholder="Masukkan Asal" value="{{ old('origin') }}" />
                @error('origin')
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
                  class="form-control @error('phone_number') is-invalid @enderror" autocomplete="off" name="phone_number"
                  value="{{ old('phone_number') }}" placeholder="Masukkan Nomor HP" />

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
                  class="form-control @error('email') is-invalid @enderror" autocomplete="off"
                  placeholder="Masukkan Email" value="{{ old('email') }}" />
                @error('email')
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
                  name="date_of_visit" value="{{ old('date_of_visit') }}" autocomplete="off" onfocus="this.showPicker()"
                  placeholder="Masukkan Asal Sekolah" />

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
                <select name="program_id" class="form-select" id="program">
                  <option value="" selected>-- Pilih Acara --</option>
                  @foreach ($program as $row)
                    <option value="{{ $row->id }}">{{ $row->program_name }}</option>
                  @endforeach
                </select>

                @error('program_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <a href="/" class="btn btn-danger mt-2 w-100">Kembali</a>
              </div>
              <div class="col-6">
                <button type="button" class="btn btn-primary w-100 mt-2" onclick="nextStep()">Lanjut</button>
              </div>
            </div>
          </div>

          <div class="step d-none" id="step2">
            <h5 class="fw-bold">Ambil Foto</h5>
            <div class="row">
              <div class="col-6">
                <h6>Kamera</h6>
                <div class="p-2">
                  <video id="webcam" class="w-100" autoplay></video>
                </div>
                <button type="button" class="btn btn-warning w-100 mt-2" onclick="takeSnapshot()"> <i
                    class="fas fa-camera"></i>&nbsp; Ambil Foto</button>
              </div>
              <div class="col-6">
                <h6>Foto</h6>
                <div class="p-2">
                  <canvas id="snapshot" class="d-none w-100"></canvas>
                </div>
                <input type="hidden" name="photo" id="imageInput">
              </div>
            </div>

            @error('photo')
              <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="row">
              <div class="col-6">
                <button type="button" class="btn btn-secondary w-100 mt-3" onclick="prevStep()">Kembali</button>
              </div>

              <div class="col-6">
                <button type="submit" class="btn btn-success w-100 mt-3">Selesai</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let currentStep = 1;

    function nextStep() {
      document.getElementById(`step${currentStep}`).classList.add('d-none');
      currentStep++;
      document.getElementById(`step${currentStep}`).classList.remove('d-none');
    }

    function prevStep() {
      document.getElementById(`step${currentStep}`).classList.add('d-none');
      currentStep--;
      document.getElementById(`step${currentStep}`).classList.remove('d-none');
    }

    const video = document.getElementById('webcam');
    navigator.mediaDevices.getUserMedia({
        video: true
      })
      .then(stream => {
        video.srcObject = stream;
      })
      .catch(error => {
        alert("Gagal mengakses webcam:", error);
      });

    function takeSnapshot() {
      const canvas = document.getElementById('snapshot');
      const context = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      canvas.classList.remove('d-none');

      const imageData = canvas.toDataURL('image/png');
      document.getElementById('imageInput').value = imageData;
    }
  </script>
@endsection
