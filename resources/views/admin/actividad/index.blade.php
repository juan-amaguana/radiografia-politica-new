@extends('layouts.admin')


@section('title', 'Actividades')

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
      Actividades
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Actividades</li>
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
              <h3 class="box-title">Actividades Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Persona</th>
                  <th>Tipo Actividad </th>

                  <th>Fuente</th>
                  <th>Posicion Actual </th>
                  <th>Posición </th>
                  <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($actividades as $actividad)
                  @if(isset($actividad->persona) )
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $actividad->id }}</td>
                    <td>{{$actividad->persona->nombres_persona}} {{$actividad->persona->apellidos_persona}}</td>
                    <td>{{$actividad->tipoActividad->nombre_tipo_actividad}}</td>
                    <td>{{$actividad->nombre_fuente_actividad}}</td>
                    <td>
                      @if($actividad->posicion_actual==0)
                        No
                      @else
                        Si
                      @endif
                    </td>
                    <td>
                      @if(isset($actividad->posicion))
                      {{$actividad->posicion->nombre_posicion}}
                      @else
                        Actividad sin posición
                      @endif
                    </td>
                    <td width="15%">
                      <a  href="{{route('actividades.show',$actividad)}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('actividades.edit',$actividad)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$actividad->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>

                  @include('admin.actividad.partials.modalEliminarActividadPolitica')
                  @endif
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
