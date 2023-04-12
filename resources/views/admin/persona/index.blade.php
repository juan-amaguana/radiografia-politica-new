@extends('layouts.admin')


@section('title', 'Personas')

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
      Personas
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/personas"><i class="fa fa-dashboard"></i> Personas</a></li>
      <li class="active">Personas</li>
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
              <h3 class="box-title">Personas Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Edad</th>
                  <th>Género</th>
                  <th>Partido político</th>
                  <th>Estado</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($personas as $persona)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $persona->id }}</td>
                    <td>
                      @if(!is_null($persona->imagen_persona))
                      <img src="{{$persona->imagen_persona}}" class="direct-chat-img">
                      @else
                      Sin imagen
                      @endif
                    </td>
                    <td>{{$persona->nombres_persona}} {{$persona->apellidos_persona}}</td>
                    
                    <td>
                      {{\Carbon\Carbon::parse($persona->fecha_nacimiento)->age}}
                    </td>
                    <td>
                      @if(is_null($persona->genero_persona))
                        Sin registro
                      @else
                        @if($persona->genero_persona==1)
                          Masculino
                        @else
                          Femenino
                        @endif
                      @endif

                    </td>
                    <td>
                      @if(isset($persona->partidoPolitico))
                      {{$persona->partidoPolitico->nombre_partido_politico}}
                      @else
                      no se le asigno partido politico
                      @endif
                    </td>
                    
                    <td>
                      @if($persona->estado_id == 1)
                        <small class="label label-warning"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @elseif($persona->estado_id == 2)
                        <small class="label label-info"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @else
                        <small class="label label-success"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @endif 
                      

                    </td>
                    <td width="19%">{{$persona->descripcion_corta_persona}}</td>
                    <td width="14%">
                      <a  href="{{route('personas.show',$persona)}}" class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('personas.edit',$persona)}}" class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger" data-persona="{{$persona->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  
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
@include('admin.persona.partials.modalEliminarPersona')
    
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
<script>
  $('#modal-danger').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 
      console.log(button.data('persona'));
      var valor_persona_id = button.data('persona')
      //alert(valor_persona_id);
      var modal = $(this)
      modal.find('.modal-body #persona-id').val(valor_persona_id);
})
</script>
@endpush
