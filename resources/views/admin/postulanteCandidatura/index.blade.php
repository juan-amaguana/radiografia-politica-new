@extends('layouts.admin')


@section('title', 'Postulantes Candidaturas') 

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
      Participantes Concursos
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Participantes Concursos</li>
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
              <h3 class="box-title">Participantes Concursos Detalle</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Persona</th>
                  <th>Concurso</th>
                  <th>Estado concurso</th>
                  <th>Posición</th>
                  <th>Estado participación</th>
                  <th width="10%">Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($postulantes as $postulante)
                @if(isset($postulante->persona))
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $postulante->id }}</td>
                    <td>{{$postulante->persona->nombres_persona}} {{$postulante->persona->apellidos_persona}}</td>
                    
                    <td>{{$postulante->candidatura->nombre_candidatura}}</td>
                    <td>
                      @if($postulante->candidatura->candidatura_abierta==0)
                        Concurso Cerrado
                      @else
                        Concurso Abierto
                      @endif
                    </td>
                    <td>
                      @if(!is_null($postulante->posicion))
                      {{$postulante->posicion->nombre_posicion}}
                      @else
                      Sin registro
                      @endif
                    </td>
                    <td>@if($postulante->candidatura->candidatura_abierta!=0)
                        El concurso se encuentra en elecciones

                    @elseif($postulante->gano_candidatura==0 && is_null($postulante->gano_candidatura))
                       El concurso necesita actualizacion
                    @elseif($postulante->gano_candidatura==0 && $postulante->gano_candidatura==0)
                       El concurso no ganó la persona
                    @else
                      El concurso ganó la persona
                    @endif</td>
                    <td width="15%">
                      <a  href="{{route('postulantesCandidaturas.show',$postulante)}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('postulantesCandidaturas.edit',$postulante)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      
                      <a  href="#modal-danger{{$postulante->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.postulanteCandidatura.partials.modalEliminarPostulanteCandidatura')
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
