@extends('layouts.admin')

@section('title', 'Ver Actividad')

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
      <li><a href="/admin/actividades/{{$actividad->id}}/edit"><i class="fa fa-dashboard"></i> Editar actividad</a></li>
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
        <i class="fa fa-user bg-blue"></i>

        <div class="timeline-item">
          <div class="timeline-body">
             
            <dl>
              <dt><span class="text-aqua">Nombres:</span></dt>
              <dd>{{$actividad->persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$actividad->persona->apellidos_persona}}</dd>
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
              <dt><span class="text-aqua">Tipo actividad:</span></dt>
              <dd>{{$actividad->tipoActividad->nombre_tipo_actividad}}</dd> 
              
              <dt><span class="text-aqua">Fuente:</span></dt>
              <dd>{{$actividad->nombre_fuente_actividad}}</dd> 

              <dt><span class="text-aqua">URI fuente:</span></dt>
              <dd><a href="{{$actividad->link_fuente_actividad}}" target="_blank" class="btn btn-warning"><i class="fa fa-hand-o-up"></i></a></dd> 


              <dt><span class="text-aqua">Posición:</span></dt>
              <dd>{{$actividad->posicion->nombre_posicion}}</dd> 

              <dt><span class="text-aqua">Partido político:</span></dt>
              <dd>
                @if(isset($actividad->partidoPolitico))
                {{$actividad->partidoPolitico->nombre_partido_politico}}
                @else
                Sin registro
                @endif
              </dd> 

              <dt><span class="text-aqua">Fecha inicio:</span></dt>
              <dd>{{$actividad->fecha_inicio_actividad}}</dd>

              <dt><span class="text-aqua">Fecha fin:</span></dt>
              <dd>{{$actividad->fecha_fin_actividad}}</dd> 



              <dt><span class="text-aqua">Posición actual:</span></dt>
              <dd>
                @if($actividad->posicion_actual==1)
                Si
                @else
                No
                @endif
              </dd>

              <dt><span class="text-aqua">Provincia:</span></dt>
              <dd>
                @if(!is_null($actividad->provincia_id))
                {{$actividad->provincia->nombre}}
                @else
                Sin registro
                @endif
                
              </dd>
              <!--
              <dt><span class="text-aqua">Cantón:</span></dt>
              <dd>
                @if(!is_null($actividad->canton_id))
                {{$actividad->canton->nombre}}
                @else
                Sin registro
                @endif
                
              </dd>
              

              <dt><span class="text-aqua">Parroquia:</span></dt>
              <dd>
                @if(!is_null($actividad->parroquia_id))
                {{$actividad->parroquia->nombre}}
                @else
                Sin registro
                @endif
                
              </dd> 
              -->
              <dt><span class="text-aqua">Descripción corta:</span></dt>
              <dd>{!!$actividad->descripcion_corta!!}</dd>

              <dt><span class="text-aqua">Descripción:</span></dt>
              <dd>
                @if(is_null($actividad->descripcion) && strlen($actividad->descripcion))
                {!!$actividad->descripcion!!}
                @else
                Sin registro
                @endif
              </dd> 
              <!--
              <dt><span class="text-aqua">El cargo es importante:</span></dt>
              <dd>@if($actividad->importante==1)
                Si
                @else
                No
                @endif</dd> 
              -->
              @if(!is_null($actividad->es_encargo_puesto))
              <dt><span class="text-aqua">La actividad es de encargo:</span></dt>
              <dd>@if($actividad->es_encargo_puesto==1)
                Si
                @else
                No
                @endif</dd> 
              @endif
              @if(!is_null($actividad->es_subrogacion_puesto))
              <dt><span class="text-aqua">La actividad es de subrogación:</span></dt>
              <dd>@if($actividad->es_subrogacion_puesto==1)
                Si
                @else
                No
                @endif</dd> 

              @endif


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
