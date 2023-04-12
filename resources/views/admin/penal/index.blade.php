@extends('layouts.admin')


@section('title', 'Penales') 

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
      Penales
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Penales</li>
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
              <h3 class="box-title">Penales Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Penal</th>
                  <th>Usuario</th>
                  <th>Tipo Judicial</th>
                  <th>Numero Penal</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($penales as $penal)
                @if(isset($penal->perfil->persona))
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $penal->id }}</td>
                    <td>{{$penal->nombre_penal}}</td>
                    <td>{{$penal->perfil->persona->nombres_persona}} {{$penal->perfil->persona->apellidos_persona}}</td>
                    <td>{{$penal->tipoJuicio->nombre_tipo_juicio}}</td>
                    <td>{{$penal->total_penal}}</td>
                    <td >
                      
                      <a  href="{{route('penales.edit',$penal)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$penal->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.penal.partials.modalEliminarPenal')
                @endif
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
