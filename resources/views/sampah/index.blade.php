@extends('layouts.admin-lte')

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <style>
    .user {
      display: inline-block;
      width: 150px;
      height: 150px;
      border-radius: 50%;

      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
    }
  </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard Gudang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Sampah</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $sampahs->count() }}</h3>

              <p>Sampah Terdaftar</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Sampah</h3>
              @can('admin')
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                    <i class="material-icons" style="font-size:14px">person_add</i> Tambah Sampah
                  </button>
                </div>
              @endcan
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Golongan</th>
                  <th>Jenis Sampah</th>
                  <th>Stok(kg)</th>
                  <th>Harga(Rp. /kg)</th>
                  <th id="Aksi">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 1 @endphp
                @foreach($sampahs as $sampah)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $sampah->id }}</td>
                    <td>{{ $sampah->golonganSampah->golongan }}</td>
                    <td>{{ $sampah->jenis_sampah }}</td>
                    <td>{{ $sampah->gudang->total_berat }}</td>
                    <td>{{ $sampah->harga_perkilogram }}</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        @can('admin')
                          <a href="#"
                             data-toggle="modal" 
                             data-target="#modal-success" 
                             data-id="{{ $sampah->id }}" 
                             data-name="{{ $sampah->name }}" 
                             data-email="{{ $sampah->email }}" 
                             data-no_telephone="{{ $sampah->no_telephone }}"
                             data-location="{{ $sampah->location }}"
                             data-profile_picture="{{ $sampah->profile_picture }}"
                             class="btn btn-success">
                             <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ route('delete.user', [ 'user_id' => $sampah->id ]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        @endcan
                      </div>
                    </td>
                  </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Golongan</th>
                  <th>Jenis Sampah</th>
                  <th>Stok(kg)</th>
                  <th>Harga(Rp. /kg)</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="modal fade" id="modal-primary">
            <div class="modal-dialog">
              <div class="modal-content bg-primary">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Sampah</h4>
                  <button type="button" class="close close-tambah" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <!-- Main content -->
                      
                      <!-- form start -->
                      <form method="POST" action="{{ route('tambah.sampah') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                          <div class="form-group">
                              <label>Golongan</label>
                              <select class="custom-select" name="golongan_id">
                                @foreach($golongans as $golongan)    
                                    <option value="{{ $golongan->id }}">{{ $golongan->golongan }}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="jenisSampah">Jenis Sampah</label>
                            <input type="text" class="form-control @error('jenis_sampah', 'tambah') is-invalid @enderror" name="jenis_sampah" id="jenisSampah" placeholder="Masukkan jenis sampah">
                            @error('jenis_sampah', 'tambah')
                              <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="jumlahStok">Stok(kg)</label>
                            <input type="number" class="form-control @error('sampah', 'tambah') is-invalid @enderror" name="stok" id="jumlahStok" min="5" placeholder="Stok">
                            @error('sampah', 'tambah')
                              <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="harga">Harga(Rp. /kg)</label>
                            <input type="number" class="form-control @error('harga', 'tambah') is-invalid @enderror" name="harga" id="harga" min="300" placeholder="Harga">
                            @error('harga', 'tambah')
                              <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                            @enderror
                          </div>
                        </div>
                        <!-- /.card-body -->
                      
                    <!-- /.card -->
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light close-tambah" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-outline-light">Simpan</button>
                    </form>
                  </div>
                  
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

  </div>
  <!-- /.container-fluid -->


  <div class="container-fluid">
    <div class="modal fade" id="modal-success">
      <div class="modal-dialog">
        <div class="modal-content bg-success">
          <div class="modal-header">
            <h4 class="modal-title">Update Sampah</h4>
            <button type="button" class="close close-update" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
                  <!-- Main content -->

              <!-- form start -->
              <form method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

                <div class="modal-body">
                    <div class="text-center">
                      <img src="" id="profile-picture" class="user elevation-2" alt="User Image">
                    </div>
                
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="inputName2">Nama</label>
                        <input type="text" class="form-control @error('name', 'edit') is-invalid @enderror" name="name" id="inputName2" placeholder="Masukkan nama">
                        @error('name', 'edit')
                          <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail2">Alamat Email</label>
                        <input type="email" class="form-control @error('email', 'edit') is-invalid @enderror" name="email" id="exampleInputEmail2" placeholder="Masukkan email">
                        @error('email', 'edit')
                          <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword2">Password</label>
                        <input type="text" class="form-control @error('password', 'edit') is-invalid @enderror" name="password" id="exampleInputPassword2" placeholder="Password">
                        @error('password', 'edit')
                          <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="inputNoTelephone2">No Telepon</label>
                        <input type="text" class="form-control @error('no_telephone', 'edit') is-invalid @enderror" name="no_telephone" id="inputNoTelephone2" placeholder="No Telepon">
                        @error('no_telephone', 'edit')
                          <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="inputLokasi2">Alamat</label>
                        <input type="text" class="form-control @error('location', 'edit') is-invalid @enderror" name="location" id="inputLokasi2" placeholder="Alamat">
                        @error('location', 'edit')
                          <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile2">Profile Picture</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="profile_picture" id="exampleInputFile2">
                            <label class="custom-file-label @error('profile_picture', 'edit') is-invalid @enderror" for="exampleInputFile2">Choose file</label>
                            @error('location', 'edit')
                              <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                            @enderror  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                
                    <!-- /.card -->
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light close-update" data-dismiss="modal">Close</button>
                      <button type="submit" class="edit btn btn-outline-light">Simpan Perubahan</button>
                    </div>
                  </form>
              </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </div>
</section>

@endsection

@section('javascripts')

  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>              
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  
  <script>
      $('#modal-success').on('show.bs.modal', function(event) {
        var link            = $(event.relatedTarget);
        var modal           = $(this);
        var id              = link.data("id");
        var name            = link.data("name");
        var email           = link.data("email");
        var no_telephone    = link.data("no_telephone");
        var location        = link.data("location");
        var profile_picture = link.data("profile_picture");
        
        modal.find('.modal-body #user_id').val(id);
        modal.find('.modal-body #inputName2').val(name);
        modal.find('.modal-body #exampleInputEmail2').val(email);
        modal.find('.modal-body #inputNoTelephone2').val(no_telephone);
        modal.find('.modal-body #inputLokasi2').val(location);
        $('#profile-picture').attr("src",profile_picture);
      });
  </script>

  <script>
    $('.close-tambah').on('click', function () {
      $("#modal-primary").find('.is-invalid').removeClass("is-invalid");
      $("#modal-primary").find('.is-valid').removeClass("is-valid");
      $("#modal-primary").find('.invalid-feedback').remove();
      $("#modal-primary").find('.valid-feedback').remove();
      $("#modal-primary").find('.error-message').remove();
    });

    $('.close-update').on('click', function () {
      $("#modal-success").find('.is-invalid').removeClass("is-invalid");
      $("#modal-success").find('.is-valid').removeClass("is-valid");
      $("#modal-success").find('.invalid-feedback').remove();
      $("#modal-success").find('.valid-feedback').remove();
      $("#modal-success").find('.error-message').remove();
    });
  </script>

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>

  <!-- Page specific script -->

<script>
  $(document).ready( function () {
   
    // Below codes are in different js file
    $.extend( $.fn.dataTable.ext.buttons.pdfHtml5, {
      
      exportOptions:  { columns:	getExportOptions()},
      
      footer: true
    });

    $.extend( $.fn.dataTable.ext.buttons.excelHtml5, {
      
      exportOptions:  { columns:	getExportOptions()},
      
      footer: true
    });

    $.extend( $.fn.dataTable.ext.buttons.copyHtml5, {
      
      exportOptions:  { columns:	getExportOptions()},
      
      footer: true
    });

    $.extend( $.fn.dataTable.ext.buttons.csvHtml5, {
      
      exportOptions:  { columns:	getExportOptions()},
      
      footer: true
    });

    $.extend( $.fn.dataTable.ext.buttons.printHtml5, { //bug
      
      exportOptions:  { columns:	getExportOptions()},
      
      footer: true
    });

    function getExportOptions()
    {	
      return [function ( idx, data, node ) 
      {
          var tableId = $(node).closest('table').attr('id');
          if (!$('#' + tableId).DataTable().column(idx).visible() || $(node).text() === 'Aksi' || $(node).hasClass('col-dt-hidden')) 
            {
              return false;
            }
            return true;
          }
      ];
    }

      var table = $('#example1').DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'] // print = bug
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
      table.column(7).visible(false)
    });

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection