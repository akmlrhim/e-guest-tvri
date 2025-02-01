@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      {{-- button tambah data  --}}
      <div class="d-flex justify-content-start mb-3">
        <a class="btn btn-primary" href="{{ route('program.create') }}">
          Tambah Data Acara
        </a>
      </div>


      {{-- data  --}}
      <div class="card">
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-bordered text-center table-sm" id="tables" style="width: 100%;">
              <thead class="font-weight-bold">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Acara</th>
                  <th scope="col">Hari Tayang</th>
                  <th scope="col">Jam Tayang</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                {{-- serverside data  --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- modal konfirmasi hapus  --}}
  @foreach ($event as $row)
    <div class="modal fade" id="modal<?= $row->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <i class="fas fa-info-circle text-danger mb-4" style="font-size: 70px;"></i>
            <p>Apakah anda yakin untuk menghapus <b>{{ $row->program_name }}</b> ?</p>
            <form action="{{ route('event.destroy', $row->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-danger">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  {{-- end modal konfirmasi hapus --}}
@endsection

@section('script')
  <script>
    $('#tables').DataTable({
      processing: true,
      autoWidth: false,
      responsive: true,
      serverSide: true,
      ajax: "{{ route('event.show') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'program_name',
          name: 'program_name'
        },
        {
          data: 'days',
          name: 'days'
        },
        {
          data: 'showtime',
          name: 'showtime',
          orderable: false
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ]
    });
  </script>
@endsection
