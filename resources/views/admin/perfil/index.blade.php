@extends('layouts.admin')


@section('title', 'Perfiles')

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
      Perfiles
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="/perfiles"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li > <a href="/admin/perfiles/create">Crear Perfil</a></li>
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
              <h3 class="box-title">Perfiles Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>imagen</th>
                  <th>Persona</th>
                  <th>Antecedentes penales</th>
                  <th>PDF</th>
                  <th>Actualizado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($perfiles as $perfil)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $perfil->id }}</td>
                    <td  width="1%" class="with-img">
                      @if(!is_null($perfil->picture))
                      <img src="{{$perfil->picture}}" class="direct-chat-img">
                      @else
                      Sin imagen
                      @endif
                    </td>
                    <td>@if(isset($perfil->persona))
                      {{$perfil->persona->nombres_persona}} {{$perfil->persona->apellidos_persona}}
                      @else
                        no ha seleccionado a una persona para el perfil con el perfil id
                        {{$perfil->id}}
                      @endif</td>
                    <td>
                      @if($perfil->antecedentes_penales==0)
                        No
                      @else
                        Si
                      @endif
                    </td>
                    <td>
                    @if(!is_null($perfil->nombre_archivo_sri))
                      Si
                      @else
                      No
                      @endif
                    </td>
                    <td>
                      {{ $perfil->updated_at}}
                    </td>
                    <td >
                      <a  href="{{route('perfiles.show',$perfil)}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>
                      <a  href="{{route('perfiles.edit',$perfil)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$perfil->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>

                  @include('admin.perfil.partials.modalEliminarPerfil')
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
