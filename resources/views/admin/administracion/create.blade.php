@extends('layouts.admin')

@section('title', 'Crear Administracion')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endpush 

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administraciones
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/administraciones"><i class="fa fa-dashboard"></i> Lista administraciones</a></li>
      <li class="active"> <a href="/administraciones/create">Crear Administracion</a> </li>
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
            <h3 class="box-title">Ingresar Administracion</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('administraciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <hr>
            <h4>Quiénes Somos</h4> <br>
            <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                    <label for="mision">Misión</label>
                    <textarea id="mision" name="mision" rows="10" cols="80">{{ old('mision') }}</textarea>
                    @if($errors->has('mision')) 
                    <p class="text-danger">{{$errors->first('mision')}}</p>

                    @endif
                  </div>
                </div>
              <div class="col-lg-12" style="display: none;">
                  <div class="form-group">
                    <label for="vision">Visión</label>
                    <textarea id="vision" name="vision" rows="10" cols="80">{{ old('vision') }}</textarea>
                    @if($errors->has('vision')) 
                    <p class="text-danger">{{$errors->first('vision')}}</p>

                    @endif
                  </div>
                </div>
            </div>
            <h4>Pie de Pagina</h4> <br>
              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Ingrese el email" required>
                    @if($errors->has('email')) 
                    <p class="text-danger">{{$errors->first('email')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Ingrese el telefono" required>
                    @if($errors->has('telefono')) 
                    <p class="text-danger">{{$errors->first('telefono')}}</p>

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
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}" placeholder="Ingrese la dirección" required>
                    @if($errors->has('direccion')) 
                    <p class="text-danger">{{$errors->first('direccion')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->

              <hr>
            <h4>Datos Abiertos</h4><br>

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="email_contacto_datos_abiertos">Email contacto datos abiertos</label>
                    <input type="email" class="form-control" value="{{ old('email_contacto_datos_abiertos') }}" name="email_contacto_datos_abiertos" id="email_contacto_datos_abiertos" placeholder="Ingrese el email de contacto datos abiertos" required>
                    @if($errors->has('email_contacto_datos_abiertos')) 
                    <p class="text-danger">{{$errors->first('email_contacto_datos_abiertos')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="autor_datos_abiertos">Autor datos abiertos</label>
                    <input type="text" class="form-control" name="autor_datos_abiertos" value="{{ old('autor_datos_abiertos') }}" id="autor_datos_abiertos" placeholder="Ingrese autor datos abiertos" required>
                    @if($errors->has('autor_datos_abiertos')) 
                    <p class="text-danger">{{$errors->first('autor_datos_abiertos')}}</p>

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
                    <label for="key_word">Key work</label>
                    <input type="text" class="form-control" name="key_word" id="key_word" value="{{ old('key_word') }}" placeholder="Ingrese los key word" required>
                    @if($errors->has('key_word')) 
                    <p class="text-danger">{{$errors->first('key_word')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="licencia">Licencia</label>
                    <select class="form-control select2" name="licencia" style="width: 100%;" required>
                    <option selected="selected">Seleccione una opcion</option>
                    
                    <option value="Creative Commons CCZero (CC0)">Creative Commons CCZero (CC0)</option>
                    <option value="Open Data Commons Public Domain Dedication and Licence (PDDL)">Open Data Commons Public Domain Dedication and Licence (PDDL)</option>
                    <option value="Creative Commons Attribution 4.0 (CC-BY-4.0)">Creative Commons Attribution 4.0 (CC-BY-4.0)</option>
                    <option value="Open Data Commons Attribution License (ODC-BY)">Open Data Commons Attribution License (ODC-BY)</option>
                    <option value="Creative Commons Attribution Share-Alike 4.0 (CC-BY-SA-4.0)">Creative Commons Attribution Share-Alike 4.0 (CC-BY-SA-4.0)</option>
                    <option value="Open Data Commons Open Database License (ODbL)">Open Data Commons Open Database License (ODbL)</option>
                    <option value="The MIT License">The MIT License</option>
                    
                  </select>
                    @if($errors->has('licencia')) 
                    <p class="text-danger">{{$errors->first('licencia')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->
              <hr>
            <h4>Cabecera</h4> <br>

              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="imagen1">Imagen 1</label>
                    <input type="file" name="imagen1" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M"  />
                    @if($errors->has('imagen1')) 
                    <p class="text-danger">{{$errors->first('imagen1')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="imagen2">Imagen 2</label>
                    <input type="file" name="imagen2" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M" />
                    @if($errors->has('imagen2')) 
                    <p class="text-danger">{{$errors->first('imagen2')}}</p>

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
                    <label for="imagen3">imagen 3</label>
                    <input type="file" name="imagen3" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M"  />
                    @if($errors->has('imagen3')) 
                    <p class="text-danger">{{$errors->first('imagen3')}}</p>

                    @endif
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <!-- /.row -->
              <!--
              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="logo_movil">Logo movil</label>
                    <input type="file" name="logo_movil" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M" required/>
                    @if($errors->has('logo_movil')) 
                    <p class="text-danger">{{$errors->first('logo_movil')}}</p>

                    @endif
                  </div>
                 
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="logo_web">Logo web</label>
                    <input type="file" name="logo_web" class="dropify" data-allowed-file-extensions="png jpg jpeg gif" data-max-file-size="2M" required/>
                    @if($errors->has('logo_web')) 
                    <p class="text-danger">{{$errors->first('logo_web')}}</p>

                    @endif
                  </div>
                 
                </div>
                
              </div>
               /.row -->

             <!-- 
              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="descripcion_logo_movil">Descripcion logo movil</label>
                    
                    <textarea name="descripcion_logo_movil" class="form-control" placeholder="Ingrese la descripcion del logo movil" id="descripcion_logo_movil" cols="30" rows="5" required>{{ old('descripcion_logo_movil') }}</textarea>
                    @if($errors->has('descripcion_logo_movil')) 
                    <p class="text-danger">{{$errors->first('descripcion_logo_movil')}}</p>

                    @endif
                  </div>
                </div>
                
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="descripcion_logo_web">Descripcion logo web</label>
                    <textarea name="descripcion_logo_web" class="form-control" placeholder="Ingrese la descripcion del logo web" id="descripcion_logo_web" cols="30" rows="5" required>{{ old('descripcion_logo_web') }}</textarea>
                    @if($errors->has('descripcion_logo_web')) 
                    <p class="text-danger">{{$errors->first('descripcion_logo_web')}}</p>

                    @endif
                  </div>
                  
                </div>
               
              </div>
              /.row -->
              
              
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
<script src="{{asset('/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    
    CKEDITOR.replace('vision')
    CKEDITOR.replace('mision')
  })
</script>
@endpush
