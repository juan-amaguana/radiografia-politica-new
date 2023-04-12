@extends('layouts.admin')

@section('title', 'Crear SRI')


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
    SRI
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/sri"><i class="fa fa-dashboard"></i> Lista SRI</a></li>
      <li class="active"> <a href="/sri/create">Crear SRI</a> </li>
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
          <h3 class="box-title">Ingresar SRI</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('sri.store') }}" method="POST" >
          @csrf
          <div class="box-body">

            <div class="row">

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre">Persona <span class="text-red">*</span></label>
                  <select class="form-control select2" name="perfil_id" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>
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

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nombre">Tipo impuesto <span class="text-red">*</span></label>
                  <select class="form-control select2" name="tipo_impuesto_sri" style="width: 100%;" required>
                    <option value="">Selecciones una opcion</option>

                    <option value="1">Impuesto de divisas</option>
                    <option value="2">Impuesto a la renta</option>

                  </select>
                  @if($errors->has('tipo_impuesto_sri'))
                  <p class="text-danger">{{$errors->first('tipo_impuesto_sri')}}</p>

                  @endif
                </div>

              </div>

            </div>
            <!-- /.row -->

            <div class="row">



              <div class="col-lg-6">
                  <div class="form-group">
                    <label for="anio_sri">Año SRI <span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="anio_sri" id="anio_sri" placeholder="Ingrese el año SRI" required>
                    @if($errors->has('anio_sri'))
                    <p class="text-danger">{{$errors->first('anio_sri')}}</p>

                    @endif
                  </div>

                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-6">
                <div class="form-group">
                  <label for="declaracion">La persona tiene monto de declaración: <span class="text-red">*</span></label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="2" onclick="tieneDeclaracio();" name="declaracion" class="flat-red"  required >
                      Si
                    </label> <br>
                    <label>
                      <input type="radio" value="1" onclick="noTieneDeclaracio();" name="declaracion"  class="flat-red"  >
                      No
                    </label>

                  </div>


                </div>

              </div>


            </div>
            <!-- /.row -->


            <div id="valores-impuesto" style="display: none;">
              <div class="row">


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="valor_impuesto_sri">Valor impuesto SRI <span class="text-aqua">(0,00)</span> <span class="text-red">*</span> </label>
                    <input type="number" step=any class="form-control" name="valor_impuesto_sri" id="valor_impuesto_sri" placeholder="Ingrese el valor del impuesto SRI. Ejm: 1995,95" required>
                    @if($errors->has('valor_impuesto_sri'))
                    <p class="text-danger">{{$errors->first('valor_impuesto_sri')}}</p>

                    @endif
                  </div>
                </div>
                <!-- /.col-lg-3 -->

              </div>
              <!-- /.row -->

            </div>



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
<script src="{{asset('/js/sri/declaracion.js')}}"></script>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
@endpush
