@extends('layouts.admin')


@section('title', 'Administración')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endpush 

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administración
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="/perfiles"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li > <a href="/administraciones/create">Crear Administración</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Administración Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Quienes somos</th>
                  <th>Teléfono</th>
                  <th>Email </th>
                  <th>Dirección</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  @if(!is_null($administracion))
                  <tr class="odd gradeX">
                    
                    
                    <td width="40%">{!! $administracion->mision!!}</td>
                    <td>{{ $administracion->telefono}}</td>
                    <td>{{ $administracion->email}}</td>
                    <td>{{ $administracion->direccion}}</td>
                    
                    <td width="15%">
                      <a  href="{{route('administraciones.show',$administracion)}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('administraciones.edit',$administracion)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$administracion->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.administracion.partials.modalEliminarAdministracion')
                  @endif
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </div>
  </section>
  <!-- /.content -->

    
@endsection
@push('scripts')
<!-- DataTables -->

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
@endpush
