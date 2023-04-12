@extends('layouts.admin')


@section('title', 'Estudios')

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
      Estudios
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Estudios</li>
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
              <h3 class="box-title">Estudios Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Usuario</th>
                  <th>Profesion</th>
                  <th>Area estudio</th>
                  <th>Títulos pregrado</th>
                  <th>Títulos posgrado</th>
                  <th>Títulos Phd</th>
                  <th>Títulos Principal</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($estudios as $estudio)
                @if(isset($estudio->perfil->persona))
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $estudio->id }}</td>
                    <td width="18%">{{$estudio->perfil->persona->nombres_persona}} {{$estudio->perfil->persona->apellidos_persona}}</td>
                    <td width="18%">{{$estudio->profesion_estudio}}</td>
                    <td width="18%">
                      @if(!is_null($estudio->estudio_area_id))
                      {{$estudio->estudioArea->nombre_estudio_area}}
                      @else
                      Sin registro
                      @endif
                    </td>
                    <td width="5%">
                      @if($estudio->pregrado_estudio<=0)
                        Sin titulos
                      @else
                        {{$estudio->pregrado_estudio}}
                      @endif
                    </td>
                    <td width="5%">
                      @if($estudio->posgrado_estudio<=0)
                      Sin titulos
                      @else
                      {{$estudio->posgrado_estudio}}
                      @endif
                    </td>
                    <td width="5%">
                      @if($estudio->phd_estudio<=1)
                      Sn titulos
                      @else
                      {{$estudio->phd_estudio}}
                      @endif
                    </td>
                    <td width="10%">
                        @if($estudio->contar_si=="pregrado_estudio")
                        Pregrado
                        @endif
                        @if($estudio->contar_si=="posgrado_estudio")
                        Posgrado
                        @endif
                        @if($estudio->contar_si=="phd_estudio")
                        Phd
                        @endif
                    </td>
                    <td width="15%">

                      <a  href="{{route('estudios.edit',$estudio)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$estudio->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>

                  @include('admin.estudio.partials.modalEliminarEstudio')
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
