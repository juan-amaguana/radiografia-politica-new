@extends('layouts.admin')

@section('title', 'Detalle Iniciativa')

@push('css')
<!-- DataTables -->
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endpush


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detallle Iniciativa
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <ol class="breadcrumb">

    </ol>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <!-- row -->
 <div class="row ">
  <div class=" col col-md-2"></div>
  <div class=" col col-md-8">
    <!-- The time line -->
    <ul class="timeline">

       <!-- timeline item -->
      <li>
        <i class="fa fa-user bg-purple"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Datos Colaborador</a></h3>
          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Nombre:</span></dt>
              <dd>{{$sumateIniciativa->nombre_aportante}}</dd>
              <dt><span class="text-aqua">telefono:</span></dt>
              <dd>{{$sumateIniciativa->telefono_aportante}}</dd>
              <dt><span class="text-aqua">Email:</span></dt>
              <dd>{{$sumateIniciativa->email_aportante}}</dd>
            </dl>
          </div>
        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-user-plus bg-blue"></i>

        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Datos Funcionario</a></h3>
          <div class="timeline-body">

            <dl>
              <dt><span class="text-aqua">Nombres funcionario:</span></dt>
              <dd>{{$persona->nombres_persona}}</dd>
              <dt><span class="text-aqua">Apellidos:</span></dt>
              <dd>{{$persona->apellidos_persona}}</dd>
              <dt><span class="text-aqua">Genero:</span></dt>
              <dd>
                @if($persona->genero_persona == 1)
                  Masculino
                @else
                  Femenino
                @endif
              </dd>
              <dt><span class="text-aqua">Fecha de nacimiento:</span></dt>
              <dd>{{$persona->fecha_nacimiento}}</dd>
              <dt><span class="text-aqua">Twitter:</span></dt>
              <dd>@ {{$persona->twitter_persona}}</dd>
              <dt><span class="text-aqua">Faccebook:</span></dt>
              <dd>{{$persona->facebook_persona}}</dd>


            </dl>
          </div>

        </div>
      </li>
      <!-- END timeline item -->

      <!-- timeline item -->
      <li>
        <i class="fa fa-comments bg-maroon"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Perfil Funcionario</a></h3>
          <div class="timeline-body">
            <dl>
              <dt><span class="text-aqua">Antecedentes Penales:</span></dt>
              <dd>
                @if($perfil->antecedentes_penales == 1)
                  Si
                @else
                  No
                @endif
              </dd>
            </dl>
          </div>
        </div>
      </li>
      <!-- END timeline item -->


      <!-- timeline item -->
      <li>
        <i class="fa fa-file-archive-o bg-orange"></i>

        <div class="timeline-item">
            <h3 class="timeline-header"><a href="#">Declaración Patrimonio</a></h3>

          <div class="timeline-body">
            <table class="table table-striped">
                <tbody><tr>
                  <th >Fecha declaración</th>
                  <th>Activos</th>
                  <th>Pasivos</th>
                </tr>
                @foreach($patrimonios as $patrimonio)
                <tr>
                  <td>{{$patrimonio->fecha_declaracion}}</td>
                  <td>{{$patrimonio->activos}}</td>
                  <td>{{$patrimonio->pasivos}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </li>
      <!-- END timeline item -->
      <!-- timeline item -->
      <li>
        <i class="fa fa-money bg-green"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Declaración Impuestos</a></h3>
          <div class="timeline-body">
            <table class="table table-striped">
                <tbody><tr>
                  <th >año declaración</th>
                  <th>monto</th>
                  <th>Tipo impuesto</th>
                </tr>
                @foreach($sris as $sri)
                <tr>
                  <td>{{$sri->anio_sri}}</td>
                  <td>{{$sri->valor_impuesto_sri}}</td>
                  <td>
                    @if($sri->tipo_impuesto_sri==2)
                      Impuesto a la renta
                    @else
                      Impuesto de divisas
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </li>
      <!-- END timeline item -->
      <!-- timeline item -->
      <li>
        <i class="fa fa-bank bg-yellow"></i>

        <div class="timeline-item">

          <h3 class="timeline-header"><a href="#">Companias</a></h3>
          <div class="timeline-body">
            <table class="table table-striped">
                <tbody><tr>
                  <th >Compania</th>
                  <th>Posición</th>
                </tr>
                @foreach($companias as $compania)
                <tr>
                  <td>{{$compania->nombre_compania}}</td>
                  <td>
                    @if($compania->posicion_compania==1)
                      Presidente
                    @elseif($compania->posicion_compania==2)
                      Gerente
                    @else
                      Accionista
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </li>
      <!-- END timeline item -->
    </ul>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>
<section class="content">

  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar nuevo Funcionario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/guardar-iniciativa" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="si_guarda">¿Desea ingesar esta iniciativa como nuevo funcionario?<span class="text-red">*</span></label>
                  <div class="form-group">
                    <label>
                      <input type="radio" value="1" onclick="mostrarSeccionesFuncionario();" name="si_guarda" class="flat-red" required>
                      SI
                    </label> <br>
                    <label>
                      <input type="radio" value="0" onclick="ocultarSeccionesFuncionario();" name="si_guarda" class="flat-red" >
                      NO
                    </label>
                  </div>
                  @if($errors->has('si_guarda'))
                  <p class="text-danger">{{$errors->first('si_guarda')}}</p>
                  @endif
                </div>
                <input type="text" name="nombre_archivo" hidden="" value="{{$sumateIniciativa->archivo_funcionario}}">
                <input type="text" name="id_iniciativa" hidden="" value="{{$sumateIniciativa->id}}">
                <div id="secciones-funcionarios" style="display: none;">
                  <div class="form-group">
                    <label for="seccion_funcionario">Selecione las secciones que desea crear<span class="text-red">*</span></label>
                    <div class="form-group">
                      <label>
                        <input type="checkbox" value="1"  id="seccion_funcionario" name="seccion_funcionario[]" required> Persona
                      </label><br>
                      <label>
                        <input type="checkbox" value="2"  name="seccion_funcionario[]"> Perfil
                      </label><br>
                      <label>
                        <input type="checkbox" value="3"  name="seccion_funcionario[]"> Declaración Patrimonio
                      </label> <br>
                      <label>
                        <input type="checkbox" value="4"  name="seccion_funcionario[]"> Declaracion SRI
                      </label> <br>
                      <label>
                        <input type="checkbox" value="5"  name="seccion_funcionario[]"> Companias
                      </label>
                    </div>
                    @if($errors->has('seccion_funcionario'))
                    <p class="text-danger">{{$errors->first('seccion_funcionario')}}</p>
                    @endif
                  </div>

                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
</section>
<!-- /.content -->


@endsection
@push('scripts')
<!-- jQuery 3 -->
<script src="{{asset('/plugins/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/plugins/blueimp_file_upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('/plugins/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/js/file_upload.js')}}"></script>
<script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/sumate_iniciativa/iniciativa.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
@endpush
