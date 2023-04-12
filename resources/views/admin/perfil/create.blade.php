@extends('layouts.admin')

@section('title', 'Crear Perfil')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Perfiles
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/perfiles"><i class="fa fa-dashboard"></i> Lista perfiles</a></li>
      <li class="active"> <a href="/perfiles/create">Crear Perfil</a> </li>
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
            <h3 class="box-title">Ingresar Perfil</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('perfiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">


              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Usuario perteneciente al perfil <span class="text-red">*</span></label>
                    <select class="form-control select2" name="persona_id" style="width: 100%;" required>
                      <option value="">Selecciones un usuario</option>
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
                  <div class="form-group">
                    <label>Antecedentes penales <span class="text-red">*</span></label>
                    <select class="form-control " name="antecedentes_penales" style="width: 100%;" required="">
                      <option value="">Seleccione una opción</option>
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->



              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL SRI</label>
                    <input type="url" class="form-control" value="https://srienlinea.sri.gob.ec/sri-en-linea/SriDeclaracionesWeb/ConsultaImpuestoRenta/Consultas/consultaImpuestoRenta" name="url_sri" id="url_sri" placeholder="Ingrese la URL del SRI" >
                    @if($errors->has('url_sri'))
                    <p class="text-danger">{{$errors->first('url_sri')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Patrimonio</label>
                    <input type="url" class="form-control" value="https://www.contraloria.gob.ec/Consultas/DeclaracionesJuradas" name="url_patrimonio" id="url_patrimonio" placeholder="Ingrese la URL del Patrimonio" >
                    @if($errors->has('url_patrimonio'))
                    <p class="text-danger">{{$errors->first('url_patrimonio')}}</p>

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
                    <label for="nombre">URL Compania</label>
                    <input type="url" class="form-control" value="https://appscvsmovil.supercias.gob.ec/portaldeinformacion/consulta_cia_param.zul" name="url_compania" id="url_compania" placeholder="Ingrese la URL de la Campania" >
                    @if($errors->has('url_compania'))
                    <p class="text-danger">{{$errors->first('url_compania')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Judicial</label>
                    <input type="url" class="form-control" value="http://consultas.funcionjudicial.gob.ec/informacionjudicial/public/informacion.jsf" name="url_judicial" id="url_judicial" placeholder="Ingrese URL de la Judicial" >
                    @if($errors->has('url_judicial'))
                    <p class="text-danger">{{$errors->first('url_judicial')}}</p>

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
                    <label for="nombre">URL Penal</label>
                    <input type="url" class="form-control" value="http://certificados.ministeriodegobierno.gob.ec/gestorcertificados/antecedentes/" name="url_penal" id="url_penal" placeholder="Ingrese la URL Penal" >
                    @if($errors->has('url_penal'))
                    <p class="text-danger">{{$errors->first('url_penal')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Estudio</label>
                    <input type="url" class="form-control" value="http://www.senescyt.gob.ec/consulta-titulos-web/faces/vista/consulta/consulta.xhtml" name="url_estudio" id="url_estudio" placeholder="Ingrese URL de Estudio" >
                    @if($errors->has('url_estudio'))
                    <p class="text-danger">{{$errors->first('url_estudio')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row" style="display: none;">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Contraloría</label>
                    <input type="url" class="form-control" name="url_contraloria" id="url_contraloria" placeholder="Ingrese la URL de Contraloria" >
                    @if($errors->has('url_contraloria'))
                    <p class="text-danger">{{$errors->first('url_contraloria')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Perfil</label>
                    <input type="url" class="form-control" name="url_perfil" id="url_perfil" placeholder="Ingrese la URL del perfil" >
                    @if($errors->has('url_perfil'))
                    <p class="text-danger">{{$errors->first('url_perfil')}}</p>

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
                    <label for="nombre">Imagen perfil <span class="text-aqua">(300x300)</span> <span class="text-red">*</span></label>
                    <input type="file" name="picture" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M" />
                    @if($errors->has('picture'))
                    <p class="text-danger">{{$errors->first('picture')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Archivo SRI <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="nombre_archivo_sri" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M" />
                    @if($errors->has('nombre_archivo_sri'))
                    <p class="text-danger">{{$errors->first('nombre_archivo_sri')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-lg-6" >
                  <div class="form-group">
                    <label for="nombre">Archivo Estudio <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="nombre_archivo_estudio" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M" />
                    @if($errors->has('nombre_archivo_estudio'))
                    <p class="text-danger">{{$errors->first('nombre_archivo_estudio')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Archivo Compania <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="nombre_archivo_compania" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M" />
                    @if($errors->has('nombre_archivo_compania'))
                    <p class="text-danger">{{$errors->first('nombre_archivo_compania')}}</p>

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
                    <label for="nombre">Archivo Judicial <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="nombre_archivo_judicial" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M" />
                    @if($errors->has('nombre_archivo_judicial'))
                    <p class="text-danger">{{$errors->first('nombre_archivo_judicial')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">Archivo Penal <span class="text-aqua">(.pdf)</span></label>
                    <input type="file" name="nombre_archivo_penal" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="2M" />
                    @if($errors->has('nombre_archivo_penal'))
                    <p class="text-danger">{{$errors->first('nombre_archivo_penal')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <div class="row">
               <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Pensiones Alimenticias <span class="text-red">*</span></label>
                    <select class="form-control " name="pensiones_alimenticias" style="width: 100%;" required="">
                      <option value="">Seleccione una opción</option>
                      <option value="0">No</option>
                      <option value="1">Si</option>
                    </select>
                  </div>

                  <input type="url" class="form-control" name="pensiones_alimenticias_fuente" id="pensiones_alimenticias_fuente" placeholder="Ingrese url de la fuente" value="{{$perfil->pensiones_alimenticias_fuente}}">
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
<script src="{{asset('/plugins/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('/plugins/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/js/file_upload.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
@endpush
