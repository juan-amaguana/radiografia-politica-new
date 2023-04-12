@extends('layouts.admin')

@section('title', 'Crear Persona')

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
    Personas
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/admin/patrimonio/{{$patrimonio->id}}/edit"><i class="fa fa-dashboard"></i> Editar patrimonio</a></li>
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
              <dd>{{$patrimonio->perfil->persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$patrimonio->perfil->persona->apellidos_persona}}</dd>
            </dl>
          </div>
          
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-yellow"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Declaración patrimonial actual</a></h3>

          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Fecha de declaración patrimonial actual:</span></dt>
              <dd>{{$patrimonio->fecha_declaracion}}</dd>
              {{--
             
              @if(!is_null($patrimonio->numero_casas))
              <dt><span class="text-aqua">Número de casas:</span></dt>
              <dd>{{$patrimonio->numero_casas}}</dd>
              @endif

              @if(!is_null($patrimonio->numero_carros))
              <dt><span class="text-aqua">Número de carros:</span></dt>
              <dd>{{$patrimonio->numero_carros}}</dd>
              @endif

              @if(!is_null($patrimonio->numero_companias))
              <dt><span class="text-aqua">Número de companias:</span></dt>
              <dd>{{$patrimonio->numero_companias}}</dd>
              @endif


              @if(!is_null($patrimonio->dinero))
              <dt><span class="text-aqua">Dinero:</span></dt>
              <dd>{{$patrimonio->dinero}}</dd>
              @endif
              --}}
              <dt><span class="text-aqua">Activos:</span></dt>
              <dd>{{$patrimonio->activos}}</dd>

              <dt><span class="text-aqua">Pasivos:</span></dt>
              <dd>{{$patrimonio->pasivos}}</dd>

              <dt><span class="text-aqua">Patrimonio:</span></dt>
              <dd>{{$patrimonio->patrimonio}}</dd>

              

              <dt><span class="text-aqua">Archivo de declaración patrimonial actual:</span></dt>
              <dd>

                @if(!is_null($patrimonio->nombre_archivo_patrimonio1))
                  <a href="{{$patrimonio->nombre_archivo_patrimonio1}}" target="_blank" class="btn btn-success"><i class="fa fa-cloud-download"></i></a>
                @else
                  No existe registro del archivo de declaración actual
                @endif


              </dd> 
              

            </dl>
          </div>
          
        </div>
      </li>

      <!-- timeline item -->
      <li>
        <i class="fa fa-file-archive-o bg-maroon"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Declaración patrimonial anterior</a></h3>          

          <div class="timeline-body">
            <dl>
              @if(!is_null($patrimonio->fecha_declaracion_anterior))
              <dt><span class="text-aqua">Fecha de declaración patrimonial acterior:</span></dt>
              <dd>{{$patrimonio->fecha_declaracion_anterior}}</dd>
              @endif
              @if(!is_null($patrimonio->nombre_archivo_patrimonio2))
              <dt><span class="text-aqua">Archivo de declaración patrimonial anterior:</span></dt>
              <dd>

                @if(!is_null($patrimonio->nombre_archivo_patrimonio2))
                  <a href="{{$patrimonio->nombre_archivo_patrimonio2}}" target="_blank" class="btn btn-warning"><i class="fa fa-cloud-download"></i></a>
                @else
                  No existe registro del archivo 2 del patrimonio
                @endif


              </dd> 
              @endif


            </dl>

          </div>
          
        </div>
      </li>
      <!-- END timeline item -->
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
  })
</script>
@endpush
