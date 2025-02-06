@extends('layouts.free_user.main')

@section('content')
  <div class="container d-flex rounded-3 justify-content-center align-items-center vh-80">
    <div class="card w-100 rounded-3" style="max-width: 900px;">
      <div class="card-body text-left">
        <h3 class="text-primary mb-3 fw-bold">DAFTAR MAGANG</h3>
        <form id="multiStepForm" action="{{ route('magang.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="step" id="step1">
            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="name" class="col-form-label-sm">Nama</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="name" name="name"
                  class="form-control form-control-sm @error('name') is-invalid @enderror" autocomplete="off" autofocus
                  placeholder="Masukkan Nama" value="{{ old('name') }}" />
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label class="col-form-label-sm">Jenis Kelamin</label>
              </div>
              <div class="col-sm-9">
                <div class="d-flex align-items-center">
                  <div class="form-check form-check-inline">
                    <input type="radio" id="laki_laki" name="gender" value="laki_laki"
                      class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                      {{ old('gender') == 'laki_laki' ? 'checked' : '' }} />
                    <label for="laki_laki" class="form-check-label col-form-label-sm">Laki-laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" id="perempuan" name="gender" value="perempuan"
                      class="form-check-input custom-radio @error('gender') is-invalid @enderror"
                      {{ old('gender') == 'perempuan' ? 'checked' : '' }} />
                    <label for="perempuan" class="form-check-label col-form-label-sm">Perempuan</label>
                  </div>
                </div>
                @error('gender')
                  <small class="text-danger mt-1 w-100">{{ $message }}</small>
                @enderror
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="institusi" class="col-form-label-sm">Asal Sekolah/institusi</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="institusi"
                  class="form-control form-control-sm @error('institution') is-invalid @enderror" name="institution"
                  value="{{ old('institution') }}" autocomplete="off" placeholder="Masukkan Asal Sekolah" />

                @error('institution')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label-sm" for="birthplace">TTL</label>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm @error('birthplace') is-invalid	@enderror"
                  value="{{ old('birthplace') }}" id="birthplace" name="birthplace" placeholder="Tempat Lahir"
                  autocomplete="off" onfocus="this.showPicker()">
                <small class="text-primary">Tempat Lahir</small><br>
                @error('birthplace')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                  value="{{ old('date_of_birth') }}" id="date_of_birth" name="date_of_birth" autocomplete="off"
                  onfocus="this.showPicker()">
                <small class="text-primary ">Tanggal Lahir</small><br>
                @error('date_of_birth')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label-sm" for="start">Durasi Magang </label>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('start') is-invalid @enderror"
                  id="start" value="{{ old('start') }}" name="start" autocomplete="off"
                  onfocus="this.showPicker()" />
                <small class="text-primary">Mulai Magang</small><br>
                @error('start')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm @error('end') is-invalid @enderror"
                  id="end" name="end" value="{{ old('end') }}" autocomplete="off"
                  onfocus="this.showPicker()" />
                <small class="text-primary">Selesai Magang</small><br>
                @error('end')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="phone_number" class="col-form-label-sm">Nomor HP</label>
              </div>
              <div class="col-sm-9">
                <input type="text" inputmode="numeric" id="phone_number"
                  class="form-control form-control-sm @error('phone_number') is-invalid @enderror" autocomplete="off"
                  name="phone_number" value="{{ old('phone_number') }}" placeholder="Masukkan Nomor HP" />

                @error('phone_number')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="email" class="col-form-label-sm">Email</label>
              </div>
              <div class="col-sm-9">
                <input type="email" id="email" name="email"
                  class="form-control form-control-sm @error('email') is-invalid @enderror" autocomplete="off"
                  placeholder="Masukkan Email" value="{{ old('email') }}" />
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="address" class="col-form-label-sm">Alamat Rumah</label>
              </div>
              <div class="col-sm-9">
                <input type="text" id="address" name="address"
                  class="form-control form-control-sm @error('address') is-invalid
									@enderror"
                  placeholder="Masukkan Alamat" value="{{ old('address') }}" autocomplete="off" />
                @error('address')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <label for="parent_number" class="col-form-label-sm">Nomor HP Orang Tua</label>
              </div>
              <div class="col-sm-9">
                <input type="text" inputmode="numeric" id="parent_number"
                  class="form-control form-control-sm @error('parent_number') is-invalid
									@enderror"
                  autocomplete="off" name="parent_number" value="{{ old('parent_number') }}"
                  placeholder="Masukkan Nomor HP Orang Tua" />
                @error('parent_number')
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
                <button type="button" class="btn btn-warning w-100 mt-2" onclick="takeSnapshot()">Ambil Foto</button>
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
        console.error("Gagal mengakses webcam:", error);
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
