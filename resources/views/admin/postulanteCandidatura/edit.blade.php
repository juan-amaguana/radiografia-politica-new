@extends('layouts.admin')

@section('title', 'Editar Participante')

@push('css')


<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/iCheck/all.css')}}">

@endpush 

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Participantes
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/postulantesCandidaturas"><i class="fa fa-dashboard"></i> Lista participantes concursos</a></li>
      <li class="active"> <a href="/postulantesCandidaturas/create">Crear Participante</a> </li>
    </ol>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Participante </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('postulantesCandidaturas.update',$postulanteCandidatura) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="box-body">
            
            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="candidatura_id">Concurso <span class="text-red">*</span></label>
                  <select class="form-control select2" name="candidatura_id" style="width: 100%;" required>
                    <option value="">Selecciones una opción</option>
                    @foreach($candidaturas as $candidatura)
                    <option value="{{$candidatura->id}}" {{ ( $postulanteCandidatura->candidatura_id == $candidatura->id ) ? 'selected' : '' }}>{{$candidatura->nombre_candidatura}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('candidatura_id')) 
                  <p class="text-danger">{{$errors->first('candidatura_id')}}</p>

                  @endif
                </div>
                
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="persona_id">Persona <span class="text-red">*</span></label>
                  <select class="form-control select2" name="persona_id" style="width: 100%;" required>
                    <option value="">Selecciones una opción</option>
                    @foreach($personas as $persona)
                    <option value="{{$persona->id}}" {{ ( $postulanteCandidatura->persona_id == $persona->id ) ? 'selected' : '' }}>{{$persona->nombres_persona}} {{$persona->apellidos_persona}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('persona_id')) 
                  <p class="text-danger">{{$errors->first('persona_id')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            

            <div class="row">

              
              
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
              <div class="form-group">
                <label for="gano_candidatura">Estado de participación <span class="text-red">*</span></label>
                <div class="form-group">
                  <label>
                    <input type="radio" value="1" name="gano_candidatura" class="flat-red" required {{ ( !is_null($postulanteCandidatura->gano_candidatura) && $postulanteCandidatura->gano_candidatura == 1 ) ? 'checked' : '' }}>
                    Participante ganó concurso
                  </label> <br>
                  <label>
                    <input type="radio" value="0" name="gano_candidatura" class="flat-red" {{ ( !is_null($postulanteCandidatura->gano_candidatura) && $postulanteCandidatura->gano_candidatura == 0 ) ? 'checked' : '' }}>
                    Participante no ganó concurso
                  </label>

                </div>
                @if($errors->has('gano_candidatura')) 
                <p class="text-danger">{{$errors->first('gano_candidatura')}}</p>
                @endif

              </div>
              </div>

            </div>
            <!-- /.row -->
            <div class="row">
              
              
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre_fuente_actividad">Fuente <span class="text-red">*</span></label>
                  
                  <input type="text" class="form-control" name="nombre_fuente_actividad" id="nombre_fuente_actividad" placeholder="Ingrese el nombre de la fuente" value="{{$postulanteCandidatura->nombre_fuente_actividad}}" required>
                  @if($errors->has('nombre_fuente_actividad')) 
                  <p class="text-danger">{{$errors->first('nombre_fuente_actividad')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>

              
            </div>
            <!-- /.row -->

            <div class="row">

              
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="link_fuente_actividad">URI Fuente</label>
                  
                  <input type="url" class="form-control" name="link_fuente_actividad" id="link_fuente_actividad" value="{{$postulanteCandidatura->link_fuente_actividad}}" placeholder="Ingrese la URI de la fuente" required>
                  @if($errors->has('link_fuente_actividad')) 
                  <p class="text-danger">{{$errors->first('link_fuente_actividad')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  
                  

                  <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5" required>{{$postulanteCandidatura->descripcion}}</textarea>
                  @if($errors->has('descripcion')) 
                  <p class="text-danger">{{$errors->first('descripcion')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
            </div>
            <!-- /.row -->

            

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
      <!-- /.box -->

    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->


@endsection
@push('scripts')
<!-- jQuery 3 -->
<script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    $('#datepicker1').datepicker({
      autoclose: true
    })
  })
</script>
@endpush
