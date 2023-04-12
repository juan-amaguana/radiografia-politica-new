@extends('layouts.admin')

@section('title', 'Editar Concurso')

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
    Concursos
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/candidaturas"><i class="fa fa-dashboard"></i> Lista concursos</a></li>
      <li class="active"> <a href="/candidaturas/create">Crear concurso</a> </li>
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
          <h3 class="box-title">Editar concurso</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('candidaturas.update',$candidatura) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="box-body">




            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre_candidatura">Nombre concurso <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="nombre_candidatura" value="{{$candidatura->nombre_candidatura}}" id="nombre_candidatura" placeholder="Ingrese el nombre del concurso" required>
                  @if($errors->has('nombre_candidatura'))
                  <p class="text-danger">{{$errors->first('nombre_candidatura')}}</p>

                  @endif
                </div>

              </div>
              <!-- /.col-lg-6 -->

              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Posición <span class="text-red">*</span></label>
                  <select class="form-control select2" name="posicion_id" style="width: 100%;" required>
                    <option value="">Selecciones una opción</option>
                    @foreach($posiciones as $posicion)
                    <option value="{{$posicion->id}}" {{ ( $candidatura->posicion_id == $posicion->id ) ? 'selected' : '' }}>{{$posicion->nombre_posicion}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('posicion_id'))
                  <p class="text-danger">{{$errors->first('posicion_id')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->



            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha inicio concurso <span class="text-red">*</span></label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_inicio_candidatura" value="{{$candidatura->fecha_inicio_candidatura}}" id="datepicker" required>
                    @if($errors->has('fecha_inicio_candidatura'))
                    <p class="text-danger">{{$errors->first('fecha_inicio_candidatura')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha fin concurso <span class="text-red">*</span></label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_fin_candidatura" value="{{$candidatura->fecha_fin_candidatura}}" id="datepicker1" required>
                    @if($errors->has('fecha_fin_candidatura'))
                    <p class="text-danger">{{$errors->first('fecha_fin_candidatura')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->
            </div>

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="es_subrogacion_puesto">Seleccione tipo consurso <span class="text-red">*</span></label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" name="es_candidatura" class="flat-red" required {{ ( $candidatura->es_candidatura == 1 ) ? 'checked' : '' }}>
                      Candidatura
                    </label> <br>
                    <label>
                      <input type="radio" value="0" name="es_candidatura" class="flat-red" {{ ( $candidatura->es_candidatura == 0 ) ? 'checked' : '' }}>
                      Postulación
                    </label>

                  </div>
                  @if($errors->has('es_subrogacion_puesto'))
                  <p class="text-danger">{{$errors->first('es_subrogacion_puesto')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="candidatura_abierta">Estado concurso <span class="text-red">*</span></label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" name="candidatura_abierta" class="flat-red" {{ ( $candidatura->candidatura_abierta == 1 ) ? 'checked' : '' }}>
                      Concurso abierto
                    </label> <br>
                    <label>
                      <input type="radio" value="0" name="candidatura_abierta" class="flat-red" {{ ( $candidatura->candidatura_abierta == 0 ) ? 'checked' : '' }}>
                      Concurso cerrado
                    </label>

                  </div>
                  @if($errors->has('candidatura_abierta'))
                  <p class="text-danger">{{$errors->first('candidatura_abierta')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->
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
