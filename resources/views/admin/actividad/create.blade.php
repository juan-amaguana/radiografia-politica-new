@extends('layouts.admin')

@section('title', 'Crear Actividad')

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
    Actividades
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/estados"><i class="fa fa-dashboard"></i> Lista Actividades </a></li>
      <li class="active"> <a href="/estados/create">Crear Actividad </a> </li>
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
          <h3 class="box-title">Ingresar Actividad </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('actividades.store') }}" method="POST">
          @csrf
          <div class="box-body">




            <div class="row">


              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Persona <span class="text-red">*</span></label>
                    <select class="form-control select2" name="persona_id" style="width: 100%;" required>
                      <option value="">Selecciones una persona <span class="text-red">*</span></option>
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
              <div class="col-lg-6">

              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group">
                  <label for="nombre_fuente_actividad">Fuente actividad <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="nombre_fuente_actividad" id="nombre_fuente_actividad" placeholder="Ingrese la fuente de la actividad " required>
                  @if($errors->has('nombre_fuente_actividad'))
                  <p class="text-danger">{{$errors->first('nombre_fuente_actividad')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="link_fuente_actividad">Link actividad <span class="text-red">*</span></label>
                  <input type="url" class="form-control" name="link_fuente_actividad" id="link_fuente_actividad" placeholder="Ingrese la url de la actividad " required>
                  @if($errors->has('link_fuente_actividad'))
                  <p class="text-danger">{{$errors->first('link_fuente_actividad')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->



            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="posicion_actual">Actividad  actual <span class="text-red">*</span></label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" onclick="posicionActual();" name="posicion_actual" class="flat-red"  required >
                      Si
                    </label> <br>
                    <label>
                      <input type="radio" value="0" onclick="posicionNoActual();" name="posicion_actual"  class="flat-red"  >
                      No
                    </label>

                  </div>
                  @if($errors->has('posicion_actual'))
                  <p class="text-danger">{{$errors->first('posicion_actual')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="posicion_id">Posición <span class="text-red">*</span></label>
                  <select class="form-control select2" name="posicion_id" id="posicion-id" onchange="getPosicion();" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>
                    @foreach($posiciones as $posicion)
                    <option value="{{$posicion->id}}">{{$posicion->nombre_posicion}}</option>
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
                  <label>Fecha inicio actividad <span class="text-red">*</span></label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_inicio_actividad" placeholder="fecha inicio de la actividad " id="datepicker" required>
                    @if($errors->has('fecha_inicio_actividad'))
                    <p class="text-danger">{{$errors->first('fecha_inicio_actividad')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group"  id="fecha-fin-actividad" style="display: none;">
                  <label>Fecha fin actividad <span class="text-red">*</span></label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_fin_actividad" placeholder="fecha fin de la actividad " id="datepicker1" required>
                    @if($errors->has('fecha_fin_actividad'))
                    <p class="text-danger">{{$errors->first('fecha_fin_actividad')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row" id="" style="">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="url_legislativo">Link Observatorio legislativo <span class="text-red"></span></label>
                  <input type="url" class="form-control pull-right" name="url_legislativo" id="url_legislativo" placeholder="URI de la gestión como asambleista" id="datepicker">
                  @if($errors->has('url_legislativo'))
                  <p class="text-danger">{{$errors->first('url_legislativo')}}</p>
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
                  <label >Partido Político </label>
                  <select class="form-control select2" name="partido_politico_id" style="width: 100%;" >
                    <option value="">Selecciones una opcion</option>
                    @foreach($partidos_politicos as $partido_politico)
                    <option value="{{$partido_politico->id}}">{{$partido_politico->nombre_partido_politico}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('partido_politico_id'))
                  <p class="text-danger">{{$errors->first('partido_politico_id')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->

              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label >Tipo actividad <span class="text-red">*</span></label>
                  <select class="form-control select2" name="tipo_actividad_id" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>
                    @foreach($tipos_actividades as $tipo_actividad)
                    <option value="{{$tipo_actividad->id}}">{{$tipo_actividad->nombre_tipo_actividad}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('tipo_actividad_id'))
                  <p class="text-danger">{{$errors->first('tipo_actividad_id')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- /.col-lg-6 -->
              <div class="col-lg-6" style="display: none;">
                  <div class="form-group">
                    <label>Sector a la que pertenece la actividad</label>
                    <select class="form-control select2" name="sector_id"  style="width: 100%;" >
                      <option value="">Selecciones un sector</option>
                      @foreach($sectores as $sector)
                      <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('sector_id'))
                    <p class="text-danger">{{$errors->first('sector_id')}}</p>

                    @endif
                  </div>
                </div>
              <!-- /.col-lg-6 -->
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Provincia</label>
                    <select class="form-control select2" name="provincia_id" id="select-provincia" onchange="getSelectValueProvincia()" style="width: 100%;" >
                      <option value="">Selecciones una provincia</option>
                      @foreach($provincias as $provincia)
                      <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('provincia_id'))
                    <p class="text-danger">{{$errors->first('provincia_id')}}</p>

                    @endif
                  </div>
                </div>
              <!-- /.col-lg-6 -->

            </div>
            <!-- /.row -->

            <div class="row" style="display: none;">
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Cantón</label>
                    <select class="form-control select2" id="select-canton" onchange="getSelectValueCanton()" name="canton_id" style="width: 100%;" >
                      <option value="">Seleccione una provincia antes que el canton</option>
                    </select>
                    @if($errors->has('canton_id'))
                    <p class="text-danger">{{$errors->first('canton_id')}}</p>

                    @endif
                  </div>
                </div>
              <!-- /.col-lg-6 -->

              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Parroquia</label>
                    <select class="form-control select2" id="select-parroquia" name="parroquia_id" style="width: 100%;" >
                      <option value="">Seleccione una provincia antes que el canton</option>
                    </select>
                    @if($errors->has('parroquia_id'))
                    <p class="text-danger">{{$errors->first('parroquia_id')}}</p>

                    @endif
                  </div>
                </div>
              <!-- /.col-lg-6 -->
            </div>

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="descripcion_corta">Descripción corta de actividad <span class="text-red">*</span></label>

                  <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" id="" cols="30" rows="5" ></textarea>
                  @if($errors->has('descripcion_corta'))
                  <p class="text-danger">{{$errors->first('descripcion_corta')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col-lg-6 -->

              {{-- <div class="col-lg-6">
                <div class="form-group">
                  <label for="descripcion">Descripción de actividad</label>

                  <textarea class="form-control" id="descripcion" name="descripcion" id="" cols="30" rows="5" ></textarea>
                  @if($errors->has('descripcion'))
                  <p class="text-danger">{{$errors->first('descripcion')}}</p>

                  @endif
                </div>
                <!-- /.form group -->
              </div> --}}
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!--
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="importante">Es importante la  actividad</label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" name="importante" class="flat-red" required>
                      Si
                    </label> <br>
                    <label>
                      <input type="radio" value="0" name="importante" class="flat-red" >
                      No
                    </label>

                  </div>
                  @if($errors->has('importante'))
                  <p class="text-danger">{{$errors->first('importante')}}</p>
                  @endif

                </div>
              </div>
              -->
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="es_encargo_puesto">La actividad es de encargo </label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" name="es_encargo_puesto"  class="flat-red">
                      Si
                    </label> <br>
                    <label>
                      <input type="radio" value="0" name="es_encargo_puesto" class="flat-red" >
                      No
                    </label>

                  </div>
                  @if($errors->has('es_encargo_puesto'))
                  <p class="text-danger">{{$errors->first('es_encargo_puesto')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->


            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="es_subrogacion_puesto">La actividad es de subrogación </label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" name="es_subrogacion_puesto" class="flat-red" >
                      Si
                    </label> <br>
                    <label>
                      <input type="radio" value="0" name="es_subrogacion_puesto" class="flat-red" >
                      No
                    </label>

                  </div>
                  @if($errors->has('es_subrogacion_puesto'))
                  <p class="text-danger">{{$errors->first('es_subrogacion_puesto')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">

              </div>
              <!-- /.col-lg-6 -->
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
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('/js/selects_provincia/carga_seletcs_provincia.js')}}"></script>
<script src="{{asset('/js/posicion/uri_gestion_asambleista.js')}}"></script>
<script src="{{asset('/js/actividad/fecha_fin.js')}}"></script>



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
