@extends('layouts.admin')


@section('title', 'Partidos políticos')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
      Partidos Políticos
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/partidosPoliticos"><i class="fa fa-dashboard"></i> Partidos Políticos</a></li>
      <li class="active">Partidos Políticos</li>
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
              <h3 class="box-title">Partidos Políticos Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Aciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($partidos_politicos as $partido_politico)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $partido_politico->id }}</td>
                    <td><img src="{{$partido_politico->imagen_partido_politico}}" class="direct-chat-img"></td>
                    <td>{{$partido_politico->nombre_partido_politico}}</td>
                    
                    <td >
                      
                      <a  href="{{route('partidosPoliticos.edit',$partido_politico)}}" class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$partido_politico->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.partido_politico.partials.modalEliminarPartidoPolitico')
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

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
@endpush
