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
      Impuestos
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Impuestos</li>
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
              <h3 class="box-title">Impuestos Detalles</h3>

              <div class="row">
                <div class="col-md-12">
                  <label >Filtros: </label>
                </div>
                <form action="{{ route('sri.index') }}" method="GET">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select class="form-control select2" name="tipo_impuesto_sri" style="width: 100%;" required>
                        <option value="">Tipo impuesto</option>
                        <option value="1">Impuesto de divisas</option>
                        <option value="2">Impuesto a la renta</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Persona</th>
                  <th>Tipo impuesto</th>
                  <th>Año</th>
                  <th>Valor impuesto</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sris as $sri)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $sri->id }}</td>
                    <td>
                      @if(isset($sri->perfil->persona))
                      {{$sri->perfil->persona->nombres_persona}} {{$sri->perfil->persona->apellidos_persona}}
                      @else
                      Sin registro
                      @endif
                    </td>
                    <td>
                      @if($sri->tipo_impuesto_sri==1)
                      Impuesto de divisas
                      @else
                      Impuesto a la renta
                      @endif
                    </td>
                    <td>{{$sri->anio_sri}}</td>
                    <td>
                      @if($sri->declaracion == 2)
                        {{$sri->valor_impuesto_sri}}
                      @else
                        No tiene monto de declaración
                      @endif

                    </td>


                    <td >

                      <a  href="{{route('sri.edit',$sri)}}"   class="btn btn-info"><i class="fa fa-edit fa-lg"></i></a>
                      <a  href="#modal-danger"  data-toggle="modal" data-impusto="{{ $sri->id }}" class="btn btn-danger"><i class="fas fa-lg fa fa-trash"></i></a>
                    </td>
                  </tr>


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


  @include('admin.sri.partials.modalEliminarSri')




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
<script>
  $('#modal-danger').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget)
      var valor_impuesto_id = button.data('impusto')
      var modal = $(this)
      modal.find('.modal-body #impusto-id').val(valor_impuesto_id);
})
</script>
@endpush
