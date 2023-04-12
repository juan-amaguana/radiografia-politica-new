@extends('layouts.admin')

@section('title', 'Ver Persona')

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
      <li><a href="/admin/personas/{{$persona->id}}/edit"><i class="fa fa-dashboard"></i> Editar Persona</a></li>
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
            <img src="{{$persona->imagen_persona}}" alt="..." class="margin">
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
              <dd>{{$persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$persona->apellidos_persona}}</dd>
              <dt><span class="text-aqua">Género:</span></dt>
              <dd>
                @if($persona->genero_persona==1)
                  Masculino
                @else
                  Femenino
                @endif

              </dd>

              <dt><span class="text-aqua">Fecha de nacimiento:</span></dt>
              <dd>
                @if(!is_null($persona->fecha_nacimiento))
                {{$persona->fecha_nacimiento}}
                @else
                Sin registro
                @endif
              </dd>

              
            </dl>
          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-green"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Partido político</a>@if(isset($persona->partidoPolitico))
                      {{$persona->partidoPolitico->nombre_partido_politico}}
                      @else
                      no se le asigno partido político
                      @endif</h3>
          <h3 class="timeline-header"><a href="#">Estado</a>@if($persona->estado_id == 1)
                        <small class="label label-warning"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @elseif($persona->estado_id == 2)
                        <small class="label label-info"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @else
                        <small class="label label-success"><i class="fa fa-clock-o"></i> {{$persona->estado->nombre_estado}}</small>
                      @endif </h3>
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-yellow"></i>

        <div class="timeline-item">
          

          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Descripción corta:</span></dt>
              <dd>{{$persona->descripcion_corta_persona}}</dd> 

              <dt><span class="text-aqua">Descripción:</span></dt>
              <dd>{!!$persona->descripcion_persona!!}</dd> 

              
            </dl>

          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-file-archive-o bg-maroon"></i>

        <div class="timeline-item">
          

          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Curriculum:</span></dt>
              <dd>

                @if(!is_null($persona->curriculum_persona))
                  <a href="{{$persona->curriculum_persona}}" target="_blank" class="btn btn-warning"><i class="fa fa-cloud-download"></i></a>
                @else
                No existe registro
                @endif

              </dd> 

              <dt><span class="text-aqua">Plan:</span></dt>
              <dd>

                @if(!is_null($persona->plan_persona))
                  <a href="{{$persona->plan_persona}}" target="_blank" class="btn btn-success"><i class="fa fa-cloud-download"></i></a>
                @else
                No existe registro
                @endif

              </dd> 

            </dl>

          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-purple"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Redes sociales</a></h3>
          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Twitter:</span></dt>
              <dd>

                @if(!is_null($persona->twitter_persona))
                  <span class="text-success">{{$persona->twitter_persona}}</span>
                @else
                Sin registro
                @endif

              </dd> 

              <dt><span class="text-aqua">Facebook:</span></dt>
              <dd>

                @if(!is_null($persona->facebook_persona))
                  <a href="{{$persona->facebook_persona}}" target="_blank" class="btn btn-primary"><i class="fa fa-facebook-official"></i></a>
                @else
                Sin registro
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
