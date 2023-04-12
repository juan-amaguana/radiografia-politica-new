@extends('layouts.admin')

@section('title', 'Editar Compania')

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
    Compañías
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/cargos"><i class="fa fa-dashboard"></i> Lista cargos</a></li>
      <li class="active"> <a href="/cargos/create">Crear Compania</a> </li>
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
          <h3 class="box-title">Editar Compania</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('companias.update',$compania) }}" method="POST">
          @method('PUT')
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
                  <option value="{{$perfil->id}}" {{ ( $perfil->id == $compania->perfil_id ) ? 'selected' : '' }}>
                    {{$perfil->persona->nombres_persona}} {{$perfil->persona->apellidos_persona}} 
                  </option>
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
                <label for="nombre_compania">Nombre compania <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="nombre_compania" value="{{$compania->nombre_compania}}" id="nombre_compania" placeholder="Ingrese nombres de la compania" required>
                @if($errors->has('nombre_compania')) 
                <p class="text-danger">{{$errors->first('nombre_compania')}}</p>

                @endif
              </div>


            </div>
            <!-- /.col-lg-6 -->
          </div>
          <!-- /.row -->

          <div class="row">

            <div class="col-lg-6">
              <div class="form-group">
                <label for="posicion_compania">Posicion compania <span class="text-red">*</span></label>
                <select class="form-control" name="posicion_compania" id="posicion_compania" required>
                    <option value="">Seleccione la posicion en la compania</option>
                    <option value="1"{{ ( $compania->posicion_compania==1 ) ? 'selected' : '' }}>Presidente</option>
                    <option value="2" {{ ( $compania->posicion_compania==2 ) ? 'selected' : '' }}>Gerente</option>
                    <option value="3" {{ ( $compania->posicion_compania==3 ) ? 'selected' : '' }}>Accionista</option>
                  </select>
                @if($errors->has('posicion_compania')) 
                <p class="text-danger">{{$errors->first('posicion_compania')}}</p>

                @endif
              </div>

            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-6" style="display: none;">
              <div class="form-group">
                <label for="total_compania">Total compania</label>
                <input type="number" class="form-control" name="total_compania" value="{{$compania->total_compania}}" id="total_compania" placeholder="Ingrese el total de la compania">
                @if($errors->has('total_compania')) 
                <p class="text-danger">{{$errors->first('total_compania')}}</p>

                @endif
              </div>
            </div>
            <!-- /.col-lg-3 -->

          </div>
          <!-- /.row -->

          <div class="row">
             <div class="col-lg-6">
              <div class="form-group">
                <label for="estado">Estado <span class="text-red">*</span></label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="">Seleccione el estado de la compania</option>
                    <option value="1"{{ ( $compania->estado==1 ) ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ ( $compania->estado==0 ) ? 'selected' : '' }}>Inactivo</option>
                </select>
                @if($errors->has('estado')) 
                <p class="text-danger">{{$errors->first('estado')}}</p>
                @endif
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="posicion">Posición <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="posicion" value="{{$compania->posicion}}" id="posicion" min="0" placeholder="Ingrese la posición" required>
                @if($errors->has('posicion')) 
                <p class="text-danger">{{$errors->first('posicion')}}</p>
                @endif
              </div>
            </div>
          </div>

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
   
  })
</script>
@endpush
