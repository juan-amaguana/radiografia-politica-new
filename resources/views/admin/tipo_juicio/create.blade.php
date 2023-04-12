@extends('layouts.admin')

@section('title', 'Crear Tipo Jucio')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tipo Jucios
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/tipoJucios"><i class="fa fa-dashboard"></i> Lista Tipo Jucios</a></li>
      <li class="active"> <a href="/tipoJucios/create">Crear Tipo Jucio</a> </li>
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
            <h3 class="box-title">Ingresar Tipo Jucio</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('tipoJucios.store') }}" method="POST">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nombre_tipo_juicio">Tipo Jucio</label>
                <input type="text" class="form-control" name="nombre_tipo_juicio" id="nombre_tipo_juicio" placeholder="Ingrese el nombre del estado" required>
                @if($errors->has('nombre_tipo_juicio')) 
                  <p class="text-danger">{{$errors->first('nombre_tipo_juicio')}}</p>

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

