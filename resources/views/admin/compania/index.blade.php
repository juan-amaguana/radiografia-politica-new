@extends('layouts.admin')


@section('title', 'Companias') 

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
      Compañías
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Companias</li>
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
              <h3 class="box-title">Companias Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Persona</th>
                  <th>Compania</th>
                  <th>Posicion</th>
                  
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companias as $compania)
                @if(isset($compania->perfil->persona))

                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $compania->id }}</td>
                    <td width="16%">
                      @if(isset($compania->perfil->persona))
                      {{$compania->perfil->persona->nombres_persona}} {{$compania->perfil->persona->apellidos_persona}} 
                      @else
                        no ha seleccionado a una persona para el perfil con el perfil id
                        {{$compania->perfil->id}}
                      @endif
                    </td>
                    <td width="20%" >
                      @if(isset($compania->nombre_compania)||$compania->nombre_compania!=""||!empty($compania->nombre_compania))
                      {{$compania->nombre_compania}}
                      @else
                        no se registro nombre de la empresa
                      @endif
                    </td>
                    <td>
                      @if($compania->posicion_compania==1)
                        Presidente
                      @elseif($compania->posicion_compania==2)
                        Gerente
                      @else
                        Accionista
                      @endif
                      

                    </td>
                    
                    
                    <td >
                      
                      <a  href="{{route('companias.edit',$compania)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger{{$compania->id}}"  data-toggle="modal" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  @include('admin.compania.partials.modalEliminarCompania')
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
