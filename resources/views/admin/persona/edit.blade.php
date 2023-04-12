@extends('layouts.admin')

@section('title', 'Crear Persona')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/public/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endpush 


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Persona
     
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/admin/personas"><i class="fa fa-dashboard"></i> Lista personas</a></li>
      <li class="active"> <a href="/admin/personas/create">Crear persona</a> </li>
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
            <h3 class="box-title">Editar persona</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{route('personas.update',$persona)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Nombres persona <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="nombres_persona" id="nombres_persona" placeholder="Ingrese nombres de la persona" required value="{{$persona->nombres_persona}}">
                    @if($errors->has('nombres_persona')) 
                    <p class="text-danger">{{$errors->first('nombres_persona')}}</p>

                    @endif
                  </div>
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Apellidos persona <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="apellidos_persona" id="apellidos_persona" placeholder="Ingrese apellidos de la persona" required value="{{$persona->apellidos_persona}}">
                    @if($errors->has('apellidos_persona')) 
                    <p class="text-danger">{{$errors->first('apellidos_persona')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Género persona <span class="text-red">*</span></label>
                    <select class="form-control select2" name="genero_persona" style="width: 100%;" required>
                      <option value="">Selecciones una opcion</option>
                      <option value="0"{{ ( $persona->genero_persona == 0 ) ? 'selected' : '' }}>Femenino</option>
                      <option value="1"{{ ( $persona->genero_persona == 1 ) ? 'selected' : '' }}>Masculino</option>
                      
                    </select>
                    @if($errors->has('genero_persona')) 
                    <p class="text-danger">{{$errors->first('genero_persona')}}</p>

                    @endif
                  </div>
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  @if(is_null($persona->fecha_nacimiento))
                  <div class="form-group">
                    <label for="fecha_nacimiento">Fecha nacimiento persona</label>
                    <input type="text" id="datepicker" class="form-control" name="fecha_nacimiento"  id="fecha_nacimiento" placeholder="Ingrese la fecha de nacimiento">
                    @if($errors->has('fecha_nacimiento')) 
                    <p class="text-danger">{{$errors->first('fecha_nacimiento')}}</p>

                    @endif
                  </div>
                  @else
                  <div class="form-group">
                    <label for="fecha_nacimiento">Fecha nacimiento persona</label>
                    <input type="text" id="datepicker" class="form-control" name="fecha_nacimiento"  value="{{date('m/d/Y', strtotime($persona->fecha_nacimiento))}}" id="fecha_nacimiento" placeholder="Ingrese la fecha de nacimiento">
                    @if($errors->has('fecha_nacimiento')) 
                    <p class="text-danger">{{$errors->first('fecha_nacimiento')}}</p>

                    @endif
                  </div>
                  @endif
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="twitter_persona">Twitter persona</label>
                    <input type="text" class="form-control" name="twitter_persona" id="twitter_persona" placeholder="Ingrese el twitter de la persona" value="{{$persona->twitter_persona}}">
                    @if($errors->has('twitter_persona')) 
                    <p class="text-danger">{{$errors->first('twitter_persona')}}</p>

                    @endif
                  </div>
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="facebook_persona">Facebook persona</label>
                    <input type="url" class="form-control" name="facebook_persona" id="facebook_persona" placeholder="Ingrese la url del facebook de la persona" value="{{$persona->facebook_persona}}">
                    @if($errors->has('facebook_persona')) 
                    <p class="text-danger">{{$errors->first('facebook_persona')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row" style="display: none;">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="descripcion_corta_persona">Descripción corta persona</label>
                    <textarea name="descripcion_corta_persona" class="form-control" id="descripcion_corta_persona" cols="30" rows="5" >{{$persona->descripcion_corta_persona}}</textarea>
                    @if($errors->has('descripcion_corta_persona')) 
                    <p class="text-danger">{{$errors->first('descripcion_corta_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="descripcion_persona">Descripción persona</label>
                    <textarea name="descripcion_persona" class="form-control" id="descripcion_persona" cols="30" rows="5" >{{$persona->descripcion_persona}}</textarea>
                    @if($errors->has('descripcion_persona')) 
                    <p class="text-danger">{{$errors->first('descripcion_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->
              

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Partido político al que pertenece la persona</label>
                    <select class="form-control select2" name="partido_politico_id" style="width: 100%;" >
                      <option value="">Selecciones un usuario</option>
                      @foreach($partidos_politicos as $partido_politico)
                      <option value="{{$partido_politico->id}}" {{ ( $partido_politico->id == $persona->partido_politico_id ) ? 'selected' : '' }}>{{$partido_politico->nombre_partido_politico}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('partido_politico_id')) 
                    <p class="text-danger">{{$errors->first('partido_politico_id')}}</p>

                    @endif
                  </div>
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Estado de la persona <span class="text-red">*</span></label>
                    <select class="form-control select2" name="estado_id" style="width: 100%;" required>
                      <option value="">Selecciones un estado</option>
                      @foreach($estados as $estado)
                      <option value="{{$estado->id}}"{{ ( $estado->id == $persona->estado_id ) ? 'selected' : '' }}>{{$estado->nombre_estado}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('estado_id')) 
                    <p class="text-danger">{{$errors->first('estado_id')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Fotografía persona <span class="text-aqua">(300x225)</span> </label>
                    <input type="file" name="imagen_persona" class="dropify" data-allowed-file-extensions="png jpg gif jpeg" data-max-file-size="2M"  />
                    @if($errors->has('imagen_persona')) 
                    <p class="text-danger">{{$errors->first('imagen_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Curriculum persona <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="curriculum_persona" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M"  />
                    @if($errors->has('curriculum_persona')) 
                    <p class="text-danger">{{$errors->first('curriculum_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="plan_persona">Plan persona <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="plan_persona" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="4M"  />
                    @if($errors->has('plan_persona')) 
                    <p class="text-danger">{{$errors->first('plan_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                  
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6" style="display: none;">
                  <div class="form-group">
                    <label for="observatorio_persona">Observatorio persona</label>
                    <textarea name="observatorio_persona" class="form-control" id="observatorio_persona" cols="30" rows="5" >{{$persona->observatorio_persona}}</textarea>
                    @if($errors->has('observatorio_persona')) 
                    <p class="text-danger">{{$errors->first('observatorio_persona')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->
              <div class="row">

                <div class="col-lg-12">
                  <label>Partidos políticos al que pertenecia la persona</label>
                  <select class="form-control select2" name="partidos_politicos_anteriores[]" id="partidos_politicos_anteriores" multiple="multiple">
                    @foreach($partidos_politicos as $partido_politico)
                      @php
                      $isSelected = 0;
                      @endphp

                      @if($persona->partidos_politicos_anteriores) 
                        @foreach (json_decode($persona->partidos_politicos_anteriores) as $anterior)
                          @php
                          if ($partido_politico->id == (int)$anterior) {
                            $isSelected = 1;
                          }
                          @endphp
                        @endforeach
                      @endif
                      <option value="{{$partido_politico->id}}" {{ ( $isSelected == 1 ) ? 'selected' : '' }}>{{$partido_politico->nombre_partido_politico}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              
              
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
<script src="{{asset('/public/plugins/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('/public/plugins/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/public/plugins/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('/public/plugins/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/public/js/file_upload.js')}}"></script>
<script src="{{asset('/public/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/public/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/public/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/public/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/public/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2() 
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
@endpush
