@extends('layouts.admin')

@section('title', 'Ver Administración')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
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
    Administración
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/admin/administraciones/{{$administracion->id}}/edit"><i class="fa fa-dashboard"></i> Editar Administración</a></li>
    </ol>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <!-- row -->
 <div class="row ">
  <div class=" col col-md-2"></div>
  <div class=" col col-md-8">
    <!-- The time line -->
    <ul class="timeline">

     
      <!-- timeline item -->
      <li>
        <i class="fa fa-hospital-o bg-blue"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Radiografía Política</a></h3> 
          <div class="timeline-body">
            
            <dl>
              <dt><span class="text-aqua">Quienes somos:</span></dt>
              <dd>{!!$administracion->mision!!}</dd>
              <dt><span class="text-aqua">Email:</span></dt>
              <dd>{{$administracion->telefono}}</dd>
              <dt><span class="text-aqua">Teléfono:</span></dt>
              <dd>{{$administracion->telefono}}</dd>
              <dt><span class="text-aqua">Dirección:</span></dt>
              <dd>{{$administracion->direccion}}</dd>
              
            </dl>
          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-green"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Datos abiertos</a></h3>
          <div class="timeline-body">
          
          <dl>
              <dt><span class="text-aqua">Autor:</span></dt>
              <dd>{{$administracion->autor_datos_abiertos}}</dd>
              <dt><span class="text-aqua">Email:</span></dt>
              <dd>{{$administracion->  email_contacto_datos_abiertos}}</dd>
              <dt><span class="text-aqua">Licencia:</span></dt>
              <dd>{{$administracion->licencia}}</dd>
              <dt><span class="text-aqua">Keywords:</span></dt>
              <dd>{{$administracion-> key_word}}</dd>
              
            </dl>
          </div>
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-yellow"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Imagenes</a></h3>

          <div class="timeline-body">
            <div class="row">
              @if(!is_null($administracion->imagen1))
              <div class="col-md-6">
                <span class="text-success"> <h4>Imagen 1</h4></span>
                <img src="/storage/administracion/imagen1/{{$administracion->imagen1}}" class="img-thumbnail" alt="">
              </div>
              @endif
              
              @if(!is_null($administracion->imagen2))
              <div class="col-md-6">
                <span class="text-success"> <h4>Imagen 2</h4></span>
                <img src="/storage/administracion/imagen1/{{$administracion->imagen2}}" class="img-thumbnail" alt="">
              </div>
              @endif

              @if(!is_null($administracion->imagen3))
              <div class="col-md-6">
                <span class="text-success"> <h4>Imagen 3</h4></span>
                <img src="/storage/administracion/imagen1/{{$administracion->imagen3}}" class="img-thumbnail" alt="">
              </div>
              @endif
            </div>
            

          </div>
          
        </div>
      </li>
      <!-- END timeline item -->
      
      
    </ul>
  </div>
  <!-- /.col -->
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
  })
</script>
@endpush
