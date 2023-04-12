@extends('layouts.admin')

@section('title', 'Crear Partido Político')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
@endpush 


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Partidos políticos
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/partidosPoliticos"><i class="fa fa-dashboard"></i> Lista partidos políticos</a></li>
      <li class="active"> <a href="/partidosPoliticos/create">Crear partido político</a> </li>
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
            <h3 class="box-title">Editar partido político</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{route('partidosPoliticos.update',$partido_politico)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">
              

              <div class="form-group">
                <label for="nombre">Nombre partido político <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="nombre_partido_politico" id="nombre_partido_politico" placeholder="Ingrese el nombre del partido político" required value="{{$partido_politico->nombre_partido_politico}}">
                @if($errors->has('nombre_partido_politico')) 
                <p class="text-danger">{{$errors->first('nombre_partido_politico')}}</p>

                @endif
              </div>

              <div class="form-group">
                <label for="nombre">Imagen del partido político <span class="text-aqua">(90x90)</span></label>
                <input type="file" name="imagen_partido_politico" class="dropify" data-allowed-file-extensions="png jpg gif jpeg" data-max-file-size="2M" />
                @if($errors->has('imagen_partido_politico')) 
                <p class="text-danger">{{$errors->first('imagen_partido_politico')}}</p>

                @endif
              </div>
              <!-- /input-group -->
              
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
@endpush
