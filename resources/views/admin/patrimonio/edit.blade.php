@extends('layouts.admin')

@section('title', 'EditarPatrimonio')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/public/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endpush


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Patrimonio
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/patrimonios"><i class="fa fa-dashboard"></i> Lista patrimonios</a></li>
      <li class="active"> <a href="/patrimonios/create">Crear patrimonio</a> </li>
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
            <h3 class="box-title">Editar Patrimonio</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{route('patrimonios.update',$patrimonio)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">

               <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="perfil_id">Persona <span class="text-red">*</span></label>
                  <select class="form-control select2" name="perfil_id" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>
                    @foreach($perfiles as $perfil)
                    @if(isset($perfil->persona))
                    <option value="{{$perfil->id}}" {{ ( $perfil->id == $patrimonio->perfil_id ) ? 'selected' : '' }}>{{$perfil->persona->nombres_persona}} {{$perfil->persona->apellidos_persona}}</option>
                    @endif
                    @endforeach
                  </select>
                  @if($errors->has('perfil_id'))
                  <p class="text-danger">{{$errors->first('perfil_id')}}</p>

                  @endif
                </div>

              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6" style="">
                <div class="form-group">
                    <div class="form-group">
                        <label>Publicar en estadisticas <span class="text-red">*</span></label>
                        <select class="form-control select2" name="publicar" style="width: 100%;" required>
                          <option value="">Pubicar</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                          <option value="ND">NO existen datos</option>
                        </select>
                      </div>
                  </div>
                </div>
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="numero_casas">Número de inmuebles</label>
                  <input type="number" class="form-control" name="numero_casas" id="numero_casas" value="{{$patrimonio->numero_casas}}" placeholder="Ingrese el numero de casas" >
                  @if($errors->has('numero_casas'))
                  <p class="text-danger">{{$errors->first('numero_casas')}}</p>

                  @endif
                </div>

              </div>
              <!-- /.col-lg-3 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="numero_carros">Número de vehículos</label>
                  <input type="number" class="form-control" name="numero_carros" id="numero_carros" value="{{$patrimonio->numero_carros}}" placeholder="Ingrese el numero de carros" >
                  @if($errors->has('numero_carros'))
                  <p class="text-danger">{{$errors->first('numero_carros')}}</p>

                  @endif
                </div>
              </div>

            </div>
            <!-- /.row -->





            <div class="row" style="display: none;">

              <!-- /.col-lg-3 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="numero_companias">Numero de companias</label>
                  <input type="number" class="form-control" name="numero_companias" id="numero_companias" value="{{$patrimonio->numero_companias}}" placeholder="Ingrese numero de companias" >
                  @if($errors->has('numero_companias'))
                  <p class="text-danger">{{$errors->first('numero_companias')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-3 -->



            </div>
            <!-- /.row -->

            <div class="row">

              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="activos">Activos <span class="text-aqua">(0.00)</span> <span class="text-red">*</span></label>
                  <input type="text" step=any class="form-control" name="activos" id="activos" value="{{$patrimonio->activos}}" placeholder="Ingrese los activos de la persona. Ejm: 1995.95" required>
                  @if($errors->has('activos'))
                  <p class="text-danger">{{$errors->first('activos')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="pasivos">Pasivos <span class="text-aqua">(0.00)</span> <span class="text-red">*</span></label>
                  <input type="text" step=any class="form-control" name="pasivos" id="pasivos" value="{{$patrimonio->pasivos}}" placeholder="Ingrese pasivos de la persona. Ejm: 1995.95" required>
                  @if($errors->has('pasivos'))
                  <p class="text-danger">{{$errors->first('pasivos')}}</p>

                  @endif
                </div>

              </div>

            </div>
            <!-- /.row -->



            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha de declaracion <span class="text-red">*</span></label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_declaracion" value="{{$patrimonio->fecha_declaracion}}" id="datepicker" required>
                    @if($errors->has('fecha_declaracion'))
                    <p class="text-danger">{{$errors->first('fecha_declaracion')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre_archivo_patrimonio1">Archivo de patrimonio actual <span class="text-aqua">(.pdf)</span></label>
                  <input type="file" name="nombre_archivo_patrimonio1" class="dropify" data-allowed-file-extensions="pdf doc docx" data-max-file-size="2M"   />
                  @if($errors->has('nombre_archivo_patrimonio1'))
                  <p class="text-danger">{{$errors->first('nombre_archivo_patrimonio1')}}</p>

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
                  <label>Fecha de declaracion patrimonial anterior</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    @if(!is_null($patrimonio->fecha_declaracion_anterior))
                    <input type="text" class="form-control pull-right" value="{{$patrimonio->fecha_declaracion_anterior}}" name="fecha_declaracion_anterior"  id="datepicker2" >
                    @else
                      <input type="text" class="form-control pull-right" name="fecha_declaracion_anterior"  id="datepicker2"  >
                    @endif
                    @if($errors->has('fecha_declaracion_anterior'))
                    <p class="text-danger">{{$errors->first('fecha_declaracion_anterior')}}</p>

                    @endif
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- /input-group -->
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre_archivo_patrimonio2">Archivo de patrimonio anterior <span class="text-aqua">(.pdf)</span></label>
                  <input type="file" name="nombre_archivo_patrimonio2" class="dropify" data-allowed-file-extensions="pdf doc docx" data-max-file-size="2M"  />
                  @if($errors->has('nombre_archivo_patrimonio2'))
                  <p class="text-danger">{{$errors->first('nombre_archivo_patrimonio2')}}</p>

                  @endif
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.col-lg-6 -->
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
<script src="{{asset('/plugins/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('/plugins/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/js/file_upload.js')}}"></script>
<script src="{{asset('/public/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/public/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })

  })
</script>
@endpush
