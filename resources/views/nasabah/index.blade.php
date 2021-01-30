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
          <h1 class="m-0">Dashboard Nasabah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Nasabah</li>
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
              <h3>{{ $nasabahs->count() }}</h3>

              <p>Nasabah Terdaftar</p>
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
              <h3 class="card-title">Daftar Nasabah</h3>
              @can('admin')
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                    <i class="material-icons" style="font-size:14px">person_add</i> Tambah User
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
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Telepon</th>
                  <th>Lokasi</th>
                  <th>Tanggal Bergabung</th>
                  <th id="Aksi" >Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0 @endphp
                @foreach($nasabahs as $nasabah)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $nasabah->name }}</td>
                    <td>{{ $nasabah->email }}</td>
                    <td>{{ $nasabah->no_telephone }}</td>
                    <td>{{ $nasabah->location }}</td>
                    <td>{{ $nasabah->created_at->translatedFormat('d/m/Y H:i') }}</td>
                    <td>
                      <i class="fas fa-info-circle" style="font-size:23px;color:blue"></i>
                      @can('admin')
                        <a
                            href="#"
                            data-toggle="modal" 
                            data-target="#modal-success" 
                            data-id="{{ $nasabah->id }}" 
                            data-name="{{ $nasabah->name }}" 
                            data-email="{{ $nasabah->email }}" 
                            data-no_telephone="{{ $nasabah->no_telephone }}"
                            data-location="{{ $nasabah->location }}"
                            data-profile_picture="{{ $nasabah->profile_picture }}"
                          >
                          <i class="far fa-edit" style="font-size:25px;color:green"></i>
                        </a>
                        <a href="{{ route('delete.nasabah', $nasabah->id) }}"><i class="fas fa-trash-alt" style="font-size:25px;color:red"></i></a>
                      @endcan
                    </td>
                  </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Telepon</th>
                  <th>Lokasi</th>
                  <th>Tanggal Bergabung</th>
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
                  <h4 class="modal-title">Tambah Nasabah</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <!-- Main content -->
                      
                      <!-- form start -->
                      <form method="POST" action="{{ route('tambah.nasabah') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Masukkan nama">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Alamat Email</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Masukkan email">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="inputNoTelephone">No Telepon</label>
                            <input type="text" class="form-control" name="no_telephone" id="inputNoTelephone" placeholder="No Telepon">
                          </div>
                          <div class="form-group">
                            <label for="inputLokasi">Alamat</label>
                            <input type="text" class="form-control" name="location" id="inputLokasi" placeholder="Alamat">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Profile Picture</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile_picture" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      
                    <!-- /.card -->
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-outline-light">Simpan</button>
                    </form>
                  </div>
                  
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

    {{-- @if (count($errors) > 0)
    <script type="text/javascript">  
      $(document).ready(function(){
      $('#update').modal('show');
      });
    </script>
    @endif --}}
    {{-- <script type="text/javascript">
      @if (count($errors) > 0)
          $('#update').modal('show');
      @endif
      </script> --}}


  </div><!-- /.container-fluid -->


</section>

<section>
    <div class="container-fluid">
        <div class="modal fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content bg-success">
              <div class="modal-header">
                <h4 class="modal-title">Update Nasabah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body">
                      <!-- Main content -->

                  <!-- form start -->
                  <form method="POST" action="{{ route('update.nasabah') }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="name" id="inputName2" placeholder="Masukkan nama">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail2">Alamat Email</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail2" placeholder="Masukkan email">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword2">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword2" placeholder="Password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="inputNoTelephone2">No Telepon</label>
                            <input type="text" class="form-control" name="no_telephone" id="inputNoTelephone2" placeholder="No Telepon">
                          </div>
                          <div class="form-group">
                            <label for="inputLokasi2">Alamat</label>
                            <input type="text" class="form-control" name="location" id="inputLokasi2" placeholder="Alamat">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile2">Profile Picture</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile_picture" id="exampleInputFile2">
                                <label class="custom-file-label" for="exampleInputFile2">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                    
                        <!-- /.card -->
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-outline-light">Simpan Perubahan</button>
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
  <!-- /.content -->
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
      // $(function() {
      //   console.log('ajax');
          // $('.simpan-perubahan').on('click', function() {
          //   console.log("Simpan Perubahan");
          //   $.ajax({
          //     url: {{ route('update.nasabah') }},
          //     data: data,
          //     type: 'put',
          //     dataType: 'json',
          //     succes: function(data) {
          //       $('#inputName2').val(data.name);
          //       $('#exampleInputEmail2').val(data.email);
          //       $('#inputNoTelephone2').val(data.no_telephone);
          //       $('#inputLokasi2').val(data.location);
          //     }
          //     error: function(data) {
          //       var errors = data.responseJSON;
          //       console.log(errors);
          //     }
          //   });
          // });
        // });
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