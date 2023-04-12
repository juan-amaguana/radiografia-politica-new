@extends('layouts.admin')

@section('title', 'Crear Judicial')

@push('css')


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
    Judiciales
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/judiciales"><i class="fa fa-dashboard"></i> Lista judiciales</a></li>
      <li class="active"> <a href="/judiciales/create">Crear Judicial</a> </li>
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
          <h3 class="box-title">Ingresar Judicial</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('judiciales.store') }}" method="POST">
          @csrf
          <div class="box-body">




            <div class="row">

              <div class="col-lg-6">
                
                <div class="form-group">
                  <label>Persona</label>
                  <select class="form-control select2" name="perfil_id" style="width: 100%;" required>
                    <option selected="selected">Seleccione una opcion</option>
                    @foreach($perfiles as $perfil)
                    @if(isset($perfil->persona))
                    <option value="{{$perfil->id}}">{{$perfil->persona->nombres_persona}} {{$perfil->persona->apellidos_persona}}</option>
                    @endif
                    @endforeach
                  </select>
                  @if($errors->has('perfil_id')) 
                  <p class="text-danger">{{$errors->first('perfil_id')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Tipo juicio</label>
                  <select class="form-control select2" name="tipo_jucio_id" style="width: 100%;" required>
                    <option selected="selected">Seleccione una opcion</option>
                    @foreach($tipo_juciales as $tipo_jucial)
                    <option value="{{$tipo_jucial->id}}">{{$tipo_jucial->nombre_tipo_juicio}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('tipo_jucio_id')) 
                  <p class="text-danger">{{$errors->first('tipo_jucio_id')}}</p>

                  @endif
                </div>
                
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

            <div class="row">

              <div class="col-lg-6">
                
                <div class="form-group">
                  <label for="nombre_judicial">Nombre Judicial</label>
                  <input type="text" class="form-control" name="nombre_judicial" id="nombre_judicial" placeholder="Ingrese al nombre judicial" required>
                  @if($errors->has('nombre_judicial')) 
                  <p class="text-danger">{{$errors->first('nombre_judicial')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="numero_judicial">Numero Judicial</label>
                  <input type="number" class="form-control" name="numero_judicial" id="numero_judicial" placeholder="Ingrese el numero judicial" required>
                  @if($errors->has('numero_judicial')) 
                  <p class="text-danger">{{$errors->first('numero_judicial')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
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
    $('#datepicker1').datepicker({
      autoclose: true
    })
  })
</script>
@endpush
