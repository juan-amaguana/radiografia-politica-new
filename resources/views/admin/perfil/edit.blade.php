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
      Perfil Persona
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Perfil persona</li>
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
            <h3 class="box-title">Editar perfil persona</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="{{route('perfiles.update',$perfil)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Persona perteneciente al perfil <span class="text-red">*</span></label>
                    <select class="form-control select2" name="persona_id" style="width: 100%;" required>
                      <option value="">Selecciones un usuario</option>
                      @foreach($personas as $persona)
                      <option value="{{$persona->id}}" {{ ( $persona->id == $perfil->persona_id ) ? 'selected' : '' }}>{{$persona->nombres_persona}} {{$persona->apellidos_persona}}</option>
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
                    <select class="form-control select2" name="antecedentes_penales" style="width: 100%;" required>
                      <option value="">Seleccione una opción</option>
                      <option value="0" {{ ( $perfil->antecedentes_penales == 0 ) ? 'selected' : '' }}>No</option>
                      <option value="1" {{ ( $perfil->antecedentes_penales == 1 ) ? 'selected' : '' }}>Si</option>
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
                    <input type="url" class="form-control" name="url_sri" id="url_sri" placeholder="Ingrese la URL del SRI" value="{{$perfil->url_sri}}">
                    @if($errors->has('url_sri'))
                    <p class="text-danger">{{$errors->first('url_sri')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->


                <div class="col-lg-6" >
                  <div class="form-group">
                    <label for="nombre">URL Patrimonio</label>
                    <input type="url" class="form-control" name="url_patrimonio" id="url_patrimonio" placeholder="Ingrese la URL del Patrimonio" value="{{$perfil->url_patrimonio}}" >
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
                    <input type="url" class="form-control" name="url_compania" id="url_compania" placeholder="Ingrese la URL de la Campania" value="{{$perfil->url_compania}}">
                    @if($errors->has('url_compania'))
                    <p class="text-danger">{{$errors->first('url_compania')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Judicial</label>
                    <input type="url" class="form-control" name="url_judicial" id="url_judicial" placeholder="Ingrese URL de la Judicial" value="{{$perfil->url_judicial}}">
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
                    <input type="url" class="form-control" name="url_penal" id="url_penal" placeholder="Ingrese la URL Penal" value="{{$perfil->url_penal}}">
                    @if($errors->has('url_penal'))
                    <p class="text-danger">{{$errors->first('url_penal')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Estudio</label>
                    <input type="url" class="form-control" name="url_estudio" id="url_estudio" placeholder="Ingrese URL de Estudio" value="{{$perfil->url_estudio}}">
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
                    <input type="url" class="form-control" name="url_contraloria" id="url_contraloria" placeholder="Ingrese la URL de Contraloria" value="{{$perfil->url_contraloria}}">
                    @if($errors->has('url_contraloria'))
                    <p class="text-danger">{{$errors->first('url_contraloria')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nombre">URL Perfil</label>
                    <input type="url" class="form-control" name="url_perfil" id="url_perfil" placeholder="Ingrese la URL del perfil" value="{{$perfil->url_perfil}}">
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
                    <label for="nombre">Imagen perfil <span class="text-aqua">(300x300)</span></label>
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

                <div class="col-lg-6">
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
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Pensiones Alimenticias <span class="text-red">*</span></label>
                    <select class="form-control select2" name="pensiones_alimenticias" style="width: 100%;" required>
                      <option value="">Seleccione una opción</option>
                      <option value="0" {{ ( $perfil->pensiones_alimenticias == 0 ) ? 'selected' : '' }}>No</option>
                      <option value="1" {{ ( $perfil->pensiones_alimenticias == 1 ) ? 'selected' : '' }}>Si</option>
                    </select>
                  </div>
                  <!-- /input-group -->
                  <input type="url" class="form-control" name="pensiones_alimenticias_fuente" id="pensiones_alimenticias_fuente" placeholder="Ingrese url de la fuente" value="{{$perfil->pensiones_alimenticias_fuente}}">
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

<script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/plugins/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('/plugins/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/js/file_upload.js')}}"></script>
@endpush
