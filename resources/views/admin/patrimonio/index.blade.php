@extends('layouts.admin')


@section('title', 'Patrimonios')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
      Patrimonios
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/personas"><i class="fa fa-dashboard"></i> Patrimonios</a></li>
      <li class="active">Patrimonios</li>
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
              <h3 class="box-title">Patrimonios Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Persona</th>
                  <th>Activos</th>
                  <th>Pasivos</th>
                  <th>Patrimonio</th>
                  <th>Fecha declaración</th>
                  <th>Publicar Estadisticas </th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($patrimonios as $patrimonio)
                  @if(isset($patrimonio->perfil->persona))
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $patrimonio->id }}</td>
                    <td>{{$patrimonio->perfil->persona->nombres_persona}} {{$patrimonio->perfil->persona->apellidos_persona}}</td>
                    <td>{{$patrimonio->activos}}</td>
                    <td>{{$patrimonio->pasivos}}</td>
                    <td>{{$patrimonio->patrimonio}}</td>
                    <td>{{$patrimonio->fecha_declaracion}}</td>
                    <td>{{$patrimonio->publicar}}</td>
                    <td >
                      <a  href="{{route('patrimonios.show',$patrimonio)}}" class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('patrimonios.edit',$patrimonio)}}" class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$patrimonio->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>

                  @include('admin.patrimonio.partials.modalEliminarPatrimonio')
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

<script src="{{ asset('/public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
@endpush
