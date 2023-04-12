@extends('layouts.admin')

@section('title', 'Crear Persona')

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
    Personas
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/admin/perfil/{{$perfil->id}}/edit"><i class="fa fa-dashboard"></i> Editar Perfil</a></li>
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
        <i class="fa fa-camera bg-purple"></i>

        <div class="timeline-item">
          <div class="timeline-body">
            <img src="{{$perfil->picture}}" alt="..." class="margin">
          </div>
        </div>
      </li>
      <!-- END timeline item -->
     
      <!-- timeline item -->
      <li>
        <i class="fa fa-user bg-blue"></i>

        <div class="timeline-item">
          <div class="timeline-body">
             
            <dl>
              <dt><span class="text-aqua">Nombres:</span></dt>
              <dd>{{$perfil->persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$perfil->persona->apellidos_persona}}</dd>
            </dl>
          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-green"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">URI perfil:</a>
                      @if(!is_null($perfil->url_perfil))
                      {{$perfil->url_perfil}}
                      @else
                      no se le asigno URI perfil
                      @endif
          </h3>
          
        </div>
      </li>
      <!-- END timeline item -->


      <!-- timeline item -->
      <li>
        <i class="fa fa-file-archive-o bg-maroon"></i>

        <div class="timeline-item">
          

          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Información SRI:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_sri))
                  <a href="{{$perfil->nombre_archivo_sri}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_sri))
                  <a href="{{$perfil->url_sri}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_sri)&&is_null($perfil->url_sri))
                  No existe registro del SRI
                @endif

              </dd> 
               
              <dt><span class="text-aqua">Información patrimonio:</span></dt>
              <dd>
                <!-- 
                @if(!is_null($perfil->nombre_archivo_patrimonio))
                  <a href="{{$perfil->nombre_archivo_patrimonio}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif
                -->  
                @if(!is_null($perfil->url_patrimonio))
                  <a href="{{$perfil->url_patrimonio}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_patrimonio)&&is_null($perfil->url_patrimonio))
                  No existe registro del patrimonio
                @endif

              </dd> 
              
              <dt><span class="text-aqua">Información compania:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_compania))
                  <a href="{{$perfil->nombre_archivo_compania}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_compania))
                  <a href="{{$perfil->url_compania}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_compania)&&is_null($perfil->url_compania))
                  No existe registro del compania
                @endif

              </dd> 

              <dt><span class="text-aqua">Información judicial:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_judicial))
                  <a href="{{$perfil->nombre_archivo_judicial}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_judicial))
                  <a href="{{$perfil->url_judicial}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_judicial)&&is_null($perfil->url_judicial))
                  No existe registro Judicial
                @endif

              </dd> 

              <dt><span class="text-aqua">Información penal:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_penal))
                  <a href="{{$perfil->nombre_archivo_penal}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_penal))
                  <a href="{{$perfil->url_penal}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_penal)&&is_null($perfil->url_penal))
                  No existe registro penal
                @endif

              </dd> 

              <dt><span class="text-aqua">Información estudios:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_estudio))
                  <a href="{{$perfil->nombre_archivo_estudio}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_estudio))
                  <a href="{{$perfil->url_estudio}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_estudio)&&is_null($perfil->url_estudio))
                  No existe registro de estudios
                @endif

              </dd> 

              <dt><span class="text-aqua">Información contraloría:</span></dt>
              <dd>

                @if(!is_null($perfil->nombre_archivo_contraloria))
                  <a href="{{$perfil->nombre_archivo_contraloria}}" target="_blank" class="btn btn-info"><i class="fa fa-cloud-download"></i></a>
                @endif

                @if(!is_null($perfil->url_contraloria))
                  <a href="{{$perfil->url_contraloria}}" target="_blank" class="btn btn-warning"><i class="fa fa-laptop"></i></a>
                @endif
                @if(is_null($perfil->nombre_archivo_contraloria)&&is_null($perfil->url_contraloria))
                  No existe registro de contraloría
                @endif

              </dd> 

              

            </dl>

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
