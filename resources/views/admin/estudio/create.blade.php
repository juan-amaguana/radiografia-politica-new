@extends('layouts.admin')

@section('title', 'Crear Estudio')

@push('css')


<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">


@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Estudios
    <small>Lista</small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/estudios"><i class="fa fa-dashboard"></i> Lista estudios</a></li>
      <li class="active"> <a href="/estudios/create">Crear Estudio</a> </li>
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
          <h3 class="box-title">Ingresar Estudio</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('estudios.store') }}" method="POST">
          @csrf
          <div class="box-body">

            <div class="row">

              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Persona <span class="text-red">*</span></label>
                    <select class="form-control select2" name="perfil_id" style="width: 100%;" required>
                      <option value="">Selecciones una persona</option>
                      @foreach($perfiles as $perfil)
                      @if($perfil->persona)
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
                  <label for="profesion_estudio">Profesión <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="profesion_estudio" id="profesion_estudio" placeholder="Ingrese la profesión" required>
                  @if($errors->has('profesion_estudio'))
                  <p class="text-danger">{{$errors->first('profesion_estudio')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->


            </div>
            <!-- /.row -->
            <div class="row">


              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Area de estudio <span class="text-red">*</span></label>
                  <select class="form-control select2" name="estudio_area_id" style="width: 100%;" required>
                    <option value="">Selecciones un area de estudio</option>
                    @foreach($estudio_areas as $estudio_area)
                    <option value="{{$estudio_area->id}}">{{$estudio_area->nombre_estudio_area}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('estudio_area_id'))
                  <p class="text-danger">{{$errors->first('estudio_area_id')}}</p>

                  @endif
                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">

                <div class="form-group">
                  <label for="pregrado_estudio">Número de títulos pregrado <span class="text-red">*</span></label>

                  <input type="number" class="form-control" name="pregrado_estudio" id="pregrado_estudio" placeholder="Ingrese el número de títulos de pregrado" required>
                  @if($errors->has('pregrado_estudio'))
                  <p class="text-danger">{{$errors->first('pregrado_estudio')}}</p>
                  @endif

                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="posgrado_estudio">Número de títulos posgrado <span class="text-red">*</span></label>
                  <input type="number" class="form-control" name="posgrado_estudio" id="posgrado_estudio" placeholder="Ingrese el número de títulos de posgrado" required>
                  @if($errors->has('posgrado_estudio'))
                  <p class="text-danger">{{$errors->first('posgrado_estudio')}}</p>
                  @endif

                </div>
              </div>
              <!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="phd_estudio">Número de títulos PhD <span class="text-red">*</span></label>
                  <input type="number" class="form-control" name="phd_estudio" id="phd_estudio" placeholder="Ingrese el número de títulos de Phd" required>
                  @if($errors->has('phd_estudio'))
                  <p class="text-danger">{{$errors->first('phd_estudio')}}</p>
                  @endif

                </div>
                <!-- /.form group -->
              </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Nivel de estudio Principal <span class="text-red">*</span></label>
                    <select class="form-control select2" name="contar_si" style="width: 100%;" required>
                      <option value="">Seleccione un nivel de estudio</option>
                      <option value="pregrado_estudio">Pregrado</option>
                      <option value="posgrado_estudio">Posgrado</option>
                      <option value="phd_estudio">Phd</option>
                    </select>
                  </div>
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




<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
@endpush
