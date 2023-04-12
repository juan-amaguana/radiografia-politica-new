@extends('layouts.admin')

@push('css')


<link type="text/css" rel="stylesheet" href="{{asset('/plugins/c3/css/c3.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/dropify/css/dropify.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">


@endpush 

@section('title', 'Graficas Radiografia Politica')

@section('content')
<div class="row">
    <div class="col-md-12">
         <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart"  id="chart-radio" style="height: 400px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
</div>
<div class="row">
        <div class="col-md-6">
         

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            <div class="box-body chart-responsive">

              <div class="form-group">
                <label for="partido_politico_bar">Partido politico</label>
                <select class="form-control select2" name="partido_politico_bar" onchange="graficaBarChartEstudios();" id="partido_politico_bar" style="width: 100%;" required>
                  @foreach($partidos_politicos as $partido_politico)
                  <option value="{{$partido_politico->id}}">{{$partido_politico->nombre_partido_politico}}</option>
                  @endforeach
                </select>

              </div>
              <div class="chart" id="chart-bar-estudios" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            
            <div class="box-body chart-responsive">
              <div class="form-group">
                  <label for="partido_politico">Partido politico</label>
                  <select class="form-control select2" name="partido_politico" onchange="graficaDountchart();" id="partido_politico" style="width: 100%;" required>
                    @foreach($partidos_politicos as $partido_politico)
                    <option value="{{$partido_politico->id}}">{{$partido_politico->nombre_partido_politico}}</option>
                    @endforeach
                  </select>
                  
            </div>
              <div class="chart" id="pie-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
@endsection 

@push('scripts')
<!-- jQuery 3 -->
<script src="https://d3js.org/d3.v5.min.js" charset="utf-8"></script>
<script src="{{asset('/plugins/c3/js/c3.js')}}"></script>
<script src="{{asset('/js/graficas_radiografia_politica/graficas.js')}}"></script>
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2() 
  })
</script>
<script>
    $(document).ready(function() {
      GraficasRadiografiaPolitica.init();
    });
  </script>

@endpush
