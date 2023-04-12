@extends('layouts.admin')

@section('title', 'Crear Posición')

@push('css')

  
  <link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
  <link type="text/css" rel="stylesheet" href="{{asset('/plugins/iCheck/all.css')}}">


 
@endpush 

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Posiciones
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/estados"><i class="fa fa-dashboard"></i> Lista posiciones</a></li>
      <li class="active"> <a href="/estados/create">Crear Posición</a> </li>
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
            <h3 class="box-title">Ingresar Posición</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('posiciones.store') }}" method="POST">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nombre_posicion">Nombre posición <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="nombre_posicion" id="nombre_posicion" placeholder="Ingrese el nombre de la posición" required>
                @if($errors->has('nombre_posicion')) 
                  <p class="text-danger">{{$errors->first('nombre_posicion')}}</p>

                @endif 
              </div> 

              
              <!-- /.form-group -->
              <div class="form-group">
                <label for="categoria_posicion_funcion">La posición pertenece a <span class="text-red">*</span></label>
                <div class="form-group">
                  <label>
                    <input type="radio" value="1" onclick="mostrarFuncionesEstado();" name="categoria_posicion_funcion" class="flat-red" required>
                    Función del Estado
                  </label> <br>
                  <label>
                    <input type="radio" value="2" onclick="mostrarInstitucionesIndependientes();" name="categoria_posicion_funcion" class="flat-red" >
                    Instituciónes independientes <br>
                  </label> <br>
                  <label>
                    <input type="radio" value="3" onclick="ocultarTodo();" name="categoria_posicion_funcion" class="flat-red" >
                    Ninguna
                  </label>
                </div>

              </div>
              
              <div id="funciones-estado" style="display: none;">
                <div class="form-group">
                <label>Categoría posición <span class="text-red">*</span></label>
                <select class="form-control select2"  required id="categoria_id" name="categoria_id" data-placeholder="Seleccione categorias"
                        style="width: 100%;">
                  <option value="">Seleccione una categoría</option>
                  @foreach($categorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->nombre_categoria}}</option>
                  @endforeach
                </select>
                @if($errors->has('categoria_id')) 
                  <p class="text-danger">{{$errors->first('categoria_id')}}</p>
                @endif
              </div>

              <div class="form-group ">
                <label>Función Estado <span class="text-red">*</span></label>
                <select class="form-control select2"  required="true" id="funcion_estado_id" name="funcion_estado_id" data-placeholder="Seleccione función del estado"
                        style="width: 100%;">
                  <option value="">Seleccione una Función del Estado</option>
                  @foreach($funciones_estado as $funcion_estado)
                  <option value="{{$funcion_estado->id}}">{{$funcion_estado->nombre}}</option>
                  @endforeach
                </select>
                @if($errors->has('funcion_estado_id')) 
                  <p class="text-danger">{{$errors->first('funcion_estado_id')}}</p>
                @endif
              </div>
                
              </div>
              

              <div class="form-group" id="instituciones-independientes" style="display: none;">
                <label>Instituciones Independientes <span class="text-red">*</span></label>
                <select class="form-control select2"  required="true" id="institucion_independiente_id" name="institucion_independiente_id" data-placeholder="Seleecione una institución independiente"
                        style="width: 100%;">
                  <option value="">Seleccione una institución independiente</option>
                  @foreach($instituciones_independientes as $institucion_independiente)
                  <option value="{{$institucion_independiente->id}}">{{$institucion_independiente->nombre}}</option>
                  @endforeach
                </select>
                @if($errors->has('institucion_independiente_id')) 
                  <p class="text-danger">{{$errors->first('institucion_independiente_id')}}</p>
                @endif
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
<script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('/js/posicion/categoria_funcion.js')}}"></script>


<script>
  $(function () {
    
    //Initialize Select2 Elements
    $('.select2').select2() 
  })
</script>
@endpush
