@extends('layouts.admin')


@section('title', 'Sumate Iniciativa')

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
      Sumate a la iniciativa
      <small>Lista</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Sumate Iniciativa</li>
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
              <h3 class="box-title">Iniciativas Detalles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Colaborador</th>
                  <th>Telefono</th>
                  <th>email</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sumate_iniciativas as $sumate_iniciativa)
                  <tr class="odd gradeX">
                    <td  width="1%" class="with-img">{{ $sumate_iniciativa->id }}</td>
                    <td>{{$sumate_iniciativa->nombre_aportante}}</td>
                    <td>{{$sumate_iniciativa->telefono_aportante}}</td>
                    <td>{{$sumate_iniciativa->email_aportante}}</td>


                    <td >

                      <a  href="/admin/detalle-iniciativa/{{$sumate_iniciativa->id}}"   class="btn btn-info"><i class="fa fa-eye fa-lg"></i></a>

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
