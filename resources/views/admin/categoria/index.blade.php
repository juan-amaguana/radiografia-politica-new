@extends('layouts.admin')


@section('title', 'Categorías')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endpush 

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categorías
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/personas"><i class="fa fa-dashboard"></i> Categorías</a></li>
      <li class="active">Categorías</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categorías Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>id</th>
                  <th>Nombre categoría</th>
                  <th>Meta descripción</th>
                  <th>Key Word</th>
                  <th>Slug</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categoria as $categorias)
                  <tr>
                    <td  width="1%" class="with-img">{{ $categorias->id }}</td>
                    <td>{{$categorias->nombre_categoria}}</td>
                    <td>{{$categorias->meta_description}}</td>
                    <td>{{$categorias->meta_keywords}}</td>
                    <td>{{$categorias->slug}}</td>
                    <td>
                      @if($categorias->estado==1)
                        <small class="label label-success"><i class="fa fa-clock-o"></i> Activo</small>
                      @else
                        <small class="label label-warning"><i class="fa fa-clock-o"></i> Inactivo</small>
                      @endif
                      
                    </td>
                    <td width="10%">
                      <a href="{{route('categorias.edit',$categorias)}}" class="btn btn-info" data-toggle="modal"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$categorias->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i>
                    </td>
                  </tr> 
                   @include('admin.categoria.partials.modalEliminarCategoria')
                  
                  
                @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </div>
  </section>
  <!-- /.content -->
    
@endsection
@push('scripts')
<!-- DataTables -->

<script src="{{ asset('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>

@endpush
