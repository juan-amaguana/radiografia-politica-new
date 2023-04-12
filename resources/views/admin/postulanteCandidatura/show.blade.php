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
      <li><a href="/admin/postulantesCandidaturas/{{$postulanteCandidatura->id}}/edit"><i class="fa fa-dashboard"></i> Editar Postulación</a></li>
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
              <dd>{{$postulanteCandidatura->persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$postulanteCandidatura->persona->apellidos_persona}}</dd>
            </dl>
          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-green"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Datos de postulacion de candidatura</a></h3>
          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Candidatura:</span></dt>
              <dd>
                
                @if(!is_null($postulanteCandidatura->candidatura_id))
                {{$postulanteCandidatura->candidatura->nombre_candidatura}}
                @else
                Sin registro
                @endif
              </dd>
              <dt><span class="text-aqua">Partido Político:</span></dt>
              <dd>
                @if(!is_null($postulanteCandidatura->partido_politico_id))
                {{$postulanteCandidatura->partidoPolitico->nombre_partido_politico}}
                @else
                Sin registro
                @endif
              </dd>
              <dt><span class="text-aqua">El postulante gano la candidatura:</span></dt>
              <dd>
                @if(is_null($postulanteCandidatura->gano_candidatura))
                No existe registro
                @elseif($postulanteCandidatura->gano_candidatura==1)
                  Si
                @else
                  No
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

          <h3 class="timeline-header"><a href="#">Fuente</a></h3>
          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Fuente de registro:</span></dt>
              <dd>
                
                @if(!is_null($postulanteCandidatura->nombre_fuente_actividad))
                {{$postulanteCandidatura->nombre_fuente_actividad}}
                @else
                Sin registro
                @endif
              </dd>
              <dt><span class="text-aqua">URI de la fuente:</span></dt>
              <dd>
                @if(!is_null($postulanteCandidatura->link_fuente_actividad))
                <a  href="{{$postulanteCandidatura->link_fuente_actividad}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                @else
                Sin registro
                @endif
              </dd>
              <dt><span class="text-aqua">Descripción:</span></dt>
              <dd>
                @if(!is_null($postulanteCandidatura->descripcion))
                {{$postulanteCandidatura->descripcion}}
                @else
                  No existe registro
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
