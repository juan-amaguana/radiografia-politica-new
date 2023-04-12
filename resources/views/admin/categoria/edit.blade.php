@extends('layouts.admin')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categorías
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Categorías</li>
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
            <h3 class="box-title">Editar Categoría</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
          <form action="{{route('categorias.update',$categoria)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nombre">Categoría <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="nombre_categoria" value="{{$categoria->nombre_categoria}}" id="nombre" placeholder="Ingrese el nombre del Categoría" required>
              </div>
              <div class="form-group">
                <label for="estado">Estado <span class="text-red">*</span></label>
                <select class="form-control" name="estado" id="estado" required>
                  <option value="">Seleccione estado</option>
                  <option value="1" {{ ( $categoria->estado == 1 ) ? 'selected' : '' }}>Activo</option>
                  <option value="0" {{ ( $categoria->estado == 0 ) ? 'selected' : '' }}>Inactivo</option>
                </select>
              </div>
              <div class="form-group">
                <label for="meta_description">Meta descripción <span class="text-red">*</span></label>
                <input type="text" class="form-control" name="meta_description" id="meta_description" value="{{$categoria->meta_description}}" placeholder="Ingrese el meta description" required>
              </div>
              <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" value="{{$categoria->slug}}" placeholder="Ingrese el url" >
              </div>
              
              <div class="form-group">
                <label for="meta_keywords">Meta keywords</label>
                <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{$categoria->meta_keywords}}" placeholder="Ingrese los meta keywords" >
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
@section('scripts')
    <!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>

<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection
