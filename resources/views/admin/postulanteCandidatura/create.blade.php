@extends('layouts.admin')

@section('title', 'Crear Postulante')

@push('css')


<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">

@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Postulantes
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/postulantesCandidaturas"><i class="fa fa-dashboard"></i> Lista postulantes candidaturas</a></li>
      <li class="active"> <a href="/postulantesCandidaturas/create">Crear Postulante</a> </li>
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
          <h3 class="box-title">Ingresar Postulante Candidatura</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('postulantesCandidaturas.store') }}" method="POST">
          @csrf
          <div class="box-body">

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="candidatura_id">Candidatura <span class="text-red">*</span></label>
                  <select class="form-control select2" name="candidatura_id" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>
                    @foreach($candidaturas as $candidatura)
                    <option value="{{$candidatura->id}}">{{$candidatura->nombre_candidatura}}</option>
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
                    <option value="">Selecciones una opcion</option>
                    @foreach($personas as $persona)
                    <option value="{{$persona->id}}">{{$persona->nombres_persona}} {{$persona->apellidos_persona}}</option>
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




              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre_fuente_actividad">Fuente <span class="text-red">*</span></label>

                  <input type="text" class="form-control" name="nombre_fuente_actividad" id="nombre_fuente_actividad" placeholder="Ingrese el nombre de la fuente" required>
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
                  <label for="link_fuente_actividad">URI Fuente <span class="text-red">*</span></label>

                  <input type="url" class="form-control" name="link_fuente_actividad" id="link_fuente_actividad" placeholder="Ingrese la URI de la fuente" required>
                  @if($errors->has('link_fuente_actividad'))
                  <p class="text-danger">{{$errors->first('link_fuente_actividad')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="descripcion">Descripción <span class="text-red"></span></label>

                  <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5" ></textarea>
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
            <button type="submit" class="btn btn-primary">Crear</button>
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



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
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
