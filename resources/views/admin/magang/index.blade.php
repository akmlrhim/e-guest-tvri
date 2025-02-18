@extends('layouts.admin.main')

@section('content')
  <div class="content">
    <div class="container-fluid">

      {{-- data  --}}
      <div class="card">
        <div class="card-body">

          <div class="row mb-4">
            <div class="col-md-3 col-12 d-flex align-items-center mb-2 mb-md-0">
              <label for="sortOrder" class="mb-0 mr-3">Urutkan:</label>
              <select id="sortOrder" class="form-control form-control-sm w-100">
                <option value="desc">Terbaru (DESC)</option>
                <option value="asc">Terlama (ASC)</option>
              </select>
            </div>
            <div class="col-md-1 d-none d-md-block"></div>
            <div
              class="col-md-5 col-12 d-flex align-items-center justify-content-md-end justify-content-start mb-2 mb-md-0">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" id="dateRange" class="form-control form-control-sm float-right"
                  placeholder="Pilih Rentang Tanggal" />
              </div>
            </div>
            <div class="col-md-3 col-12 d-flex align-items-center justify-content-md-end justify-content-start">
              <button class="btn btn-sm btn-success w-100" data-toggle="modal" data-target="#cetakModal">Cetak
                Data</button>
            </div>
          </div>

          <div class="table-responsive-sm">
            <table class="table table-bordered text-center table-sm text-sm" id="tables" style="width: 100%;">
              <thead class="font-weight-bold">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Instansi/Asal</th>
                  <th scope="col">Mulai Magang</th>
                  <th scope="col">Selesai Magang</th>
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
  @foreach ($intern as $row)
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
            <form action="{{ route('admin.magang.destroy', $row->id) }}" method="POST">
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


  {{-- modal cetak  --}}
  <div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cetakModalLabel">Cetak Peserta Magang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="modalDateRange" class="form-control form-control-sm float-right"
              placeholder="Pilih Rentang Tanggal" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" id="printButton" class="btn btn-primary">Cetak Data</button>
        </div>
      </div>
    </div>
  </div>
  {{-- end modal cetak  --}}
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
          url: "{{ route('admin.magang.show') }}",
          data: function(d) {
            d.sortOrder = $('#sortOrder').val();
            let dateRange = $('#dateRange').val().split(' - ');
            if (dateRange.length == 2) {
              d.startDate = dateRange[0];
              d.endDate = dateRange[1];
            }
          }
        },
        order: [],
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'name',
            name: 'name',
            orderable: false
          },
          {
            data: 'gender',
            name: 'gender',
            orderable: false
          },
          {
            data: 'institution',
            name: 'institution',
            orderable: false
          },
          {
            data: 'start',
            orderable: false
          }, {
            data: 'end',
            orderable: false
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

      // filter date range 
      $('#dateRange').daterangepicker({
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Clear',
          format: 'DD-MM-YYYY'
        }
      });

      $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        table.ajax.reload();
      });

      $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        table.ajax.reload();
      });
      //

      // cetak modal 
      $('#cetakModal').on('shown.bs.modal', function() {
        $('#modalDateRange').daterangepicker({
          autoUpdateInput: false,
          locale: {
            cancelLabel: 'Clear',
            format: 'DD-MM-YYYY'
          }
        });

        $('#modalDateRange').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        });

        $('#modalDateRange').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });

        $('#printButton').on('click', function() {
          var dateRange = $('#modalDateRange').val().split(' - ');

          if (dateRange.length === 2) {
            var startDate = moment(dateRange[0], 'DD-MM-YYYY').format('YYYY-MM-DD');
            var endDate = moment(dateRange[1], 'DD-MM-YYYY').format('YYYY-MM-DD');

            window.location.href = "{{ route('admin.magang.cetak') }}?startDate=" + startDate + "&endDate=" +
              endDate;
          } else {
            alert('Harap pilih rentang tanggal terlebih dahulu.');
          }
        });
      });
      //
    });
  </script>
@endsection
