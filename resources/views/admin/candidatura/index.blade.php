@extends('layouts.admin')


@section('title', 'Candidaturas') 

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
      Candidaturas
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Candidaturas</li>
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
              <h3 class="box-title">Candidaturas Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Concurso</th>
                  <th>Tipo Consurso</th>
                  <th>Posicion Concurso</th>
                  <th>Fecha inicio</th>
                  <th>Fecha fin</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($candidaturas as $candidatura)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $candidatura->id }}</td>
                    <td>{{$candidatura->nombre_candidatura}}</td>
                    <td>
                      @if($candidatura->es_candidatura==1 && !is_null($candidatura->es_candidatura))
                        Candidatura
                      @elseif($candidatura->es_candidatura==0 && !is_null($candidatura->es_candidatura))
                      Postulación
                      @else
                      Sin registro
                      @endif
                    </td>
                    <td>
                      @if(!is_null($candidatura->posicion_id))
                      {{$candidatura->posicion->nombre_posicion}}
                      @else
                      Sin registro
                      @endif
                    </td>
                    <td>{{$candidatura->fecha_inicio_candidatura}}</td>
                    <td>{{$candidatura->fecha_fin_candidatura}}</td>
                    <td>
                      @if($candidatura->candidatura_abierta==0)
                        Concurso Cerrado
                      @else
                        Concurso Abierto
                      @endif
                    </td>
                    <td >
                      
                      <a  href="{{route('candidaturas.edit',$candidatura)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      
                      <a  href="#modal-danger{{$candidatura->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.candidatura.partials.modalEliminarCandidatura')
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
