@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      {{-- data  --}}
      <div class="card">
        <div class="card-body">

          <div class="mb-3">
            <label for="sortOrder" class="mr-2">Urutkan:</label>
            <select id="sortOrder" class="form-control d-inline-block w-auto">
              <option value="desc">DESC</option>
              <option value="asc">ASC</option>
            </select>
          </div>

          <div class="table-responsive-sm">
            <table class="table table-bordered text-center table-sm text-sm" id="tables" style="width: 100%;">
              <thead class="font-weight-bold">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama </th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Email</th>
                  <th scope="col">No. HP</th>
                  <th scope="col">Asal</th>
                  <th scope="col">Tujuan</th>
                  <th scope="col"></th>
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
  @foreach ($guest as $row)
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
            <p>Apakah anda yakin untuk menghapus <b>{{ $row->name }}</b> ?</p>
            <form action="{{ route('admin.tamu.destroy', $row->id) }}" method="POST">
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
    $(document).ready(function() {
      let table = $('#tables').DataTable({
        processing: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        ajax: {
          url: "{{ route('admin.tamu.show') }}",
          data: function(d) {
            d.sortOrder = $('#sortOrder').val();
          }
        },
        order: [
          [4, 'desc']
        ],
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'gender',
            name: 'gender'
          },
          {
            data: 'email',
            name: 'email',
          },
          {
            data: 'phone_number',
            name: 'phone_number',
          },
          {
            data: 'origin',
            name: 'origin',
          },
          {
            data: 'objectives',
            name: 'objectives',
          },
          {
            data: 'created_at',
            name: 'created_at',
            visible: false
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });

      $('#sortOrder').on('change', function() {
        table.ajax.reload();
      });
    });
  </script>
@endsection
