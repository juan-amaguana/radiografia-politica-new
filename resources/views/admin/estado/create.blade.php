@extends('layouts.admin')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Estados
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <ol class="breadcrumb">
      <li><a href="/estados"><i class="fa fa-dashboard"></i> Lista estados</a></li>
      <li class="active"> <a href="/estados/create">Crear Estado</a> </li>
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
            <h3 class="box-title">Ingresar Estado</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('estados.store') }}" method="POST">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nombre">Estado</label>
                <input type="text" class="form-control" name="nombre_estado" id="nombre_estado" placeholder="Ingrese el nombre del estado" required>
                @if($errors->has('nombre_estado')) 
                  <p class="text-danger">{{$errors->first('nombre_estado')}}</p>

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
