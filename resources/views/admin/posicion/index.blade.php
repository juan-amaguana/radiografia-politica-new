@extends('layouts.admin')


@section('title', 'Posiciones') 

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
      Posiciones
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Posiciones</li>
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
              <h3 class="box-title">Posiciones Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Nombre posición</th>
                  <th>Función</th>
                  <th>Tipo posición</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posiciones as $posicion)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $posicion->id }}</td>
                    <td>{{$posicion->nombre_posicion}}</td>
                    
                    <td>
                      @if(isset($posicion->funcion_estado))
                        {{$posicion->funcion_estado->nombre}}
                        
                      @else
                        Ninguna
                      @endif
                    </td>
                    <td>
                      @if(isset($posicion->funcion_estado))
                        @if($posicion->funcion_estado->categoria == 0)
                        Función estado
                        @else
                        Institución independiente
                        @endif
                      @else
                        Ninguna
                      @endif
                    </td>
                    <td >
                      <a  href="#modal-info{{$posicion->id}}"  data-toggle="modal" class="btn btn-info"><i class="fas fa-lg fa fa-eye"></i></a>
                      <a  href="{{route('posiciones.edit',$posicion)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$posicion->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  @include('admin.posicion.partials.modalShowPosicion')
                  @include('admin.posicion.partials.modalEliminarPosicion')
                @endforeach
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
