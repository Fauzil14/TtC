@extends('layouts.admin-lte')

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  
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

              <p>User Registrations</p>
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
      <i class="material-icons person_add"></i>
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
                <i class="far fa-edit" style="font-size:25px;color:green"></i>
                <i class="fas fa-trash-alt" style="font-size:25px;color:red"></i>
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


    </div><!-- /.container-fluid -->
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
  
  {{-- <script> 
    $ ( function () {
        $('#datatable').DataTable();
    })
  </script> --}}

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
    } );

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