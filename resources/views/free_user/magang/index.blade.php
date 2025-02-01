@extends('layouts.free_user.main')

@section('content')
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg w-100" style="max-width: 800px;">
      <div class="card-body text-left">
        <h2 class="text-primary mb-4 font-weight-bold">DAFTAR MAGANG</h2>
        <form id="multiStepForm">
          <div class="step" id="step1">
            <h4 class="text-secondary">Data Pribadi</h4>
            <div class="mb-3 text-start">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" id="nama" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
              <label for="email" class="form-lab	el">Email</label>
              <input type="email" id="email" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary w-100 mt-3" onclick="nextStep()">Lanjut</button>
          </div>

          <div class="step d-none" id="step2">
            <h4 class="text-secondary">Ambil Gambar</h4>
            <div class="row">
              <div class="col-6">
                <h5 class="text-secondary">Kamera</h5>
                <div class="border rounded p-2">
                  <video id="webcam" class="w-100" autoplay></video>
                </div>
                <button type="button" class="btn btn-warning w-100 mt-2" onclick="takeSnapshot()">Ambil Foto</button>
              </div>
              <div class="col-6">
                <h5 class="text-secondary">Foto yang Diambil</h5>
                <canvas id="snapshot" class="d-none mt-2 w-100"></canvas>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <button type="button" class="btn btn-secondary w-100 mt-3" onclick="prevStep()">Kembali</button>
              </div>

              <div class="col-6">
                <button type="submit" class="btn btn-success w-100 mt-3">Kirim</button>
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
    }
  </script>
@endsection
