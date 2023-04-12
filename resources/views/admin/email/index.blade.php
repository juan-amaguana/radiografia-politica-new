@extends('layouts.admin')


@section('title', 'Personas')

@push('css')
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css"> 


@endpush 

@section('content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">12</span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contactos con Radiografia Política</h3>

              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  
                </div>
                <a href="javascript:location.reload()" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
            
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach($contactos_observatorio as $mensaje)
                  <?php
                  $date = \Carbon\Carbon::parse($mensaje->created_at); 
                  $now = \Carbon\Carbon::now(); 
                  $diff = $date->diffInDays($now);
                  $date_substr = substr($mensaje->created_at, 0, -9);


                  ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-name"><a href="/admin/mensaje-detalle/{{$mensaje->id}}">{{$mensaje->nombre_contacto}}</a></td>
                    <td class="mailbox-subject"><b>{{$mensaje->asunto_contacto}}</b> - {{substr($mensaje->mensaje_contacto, 0, 15)}}....
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">
                      @if($diff==0)
                      Today
                      @elseif($diff>=1 && $diff<10)
                      {{$diff}} day ago
                      @else
                      {{$date_substr}}
                      @endif
                    </td>
                  </tr>
                 @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
               
                <div class="btn-group">
                 {{ $contactos_observatorio->count() }} / {{ $contactos_observatorio->total() }} total mensajes
                </div>
               
                
                <div class="pull-right">
                  <div class="btn-group">
                    {{ $contactos_observatorio->links() }}
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    
@endsection
@push('scripts')
<!-- iCheck -->
<script src="/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@endpush
