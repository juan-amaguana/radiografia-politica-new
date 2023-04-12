<!-- /.modal -->

<div class="modal modal-info fade" id="modal-info{{$tipo_jucio->id}}">
  <form  method="POST" action="{{route('tipoJucios.update',$tipo_jucio)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('PUT')
    @csrf 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar Tipo Jucio</h4>
        </div>
        <div class="modal-body">

          
          <div class="box-body">
              <div class="form-group">
                <label for="nombre_tipo_juicio">Tipo Jucio</label>
                <input type="text" class="form-control" name="nombre_tipo_juicio" id="nombre_tipo_juicio" placeholder="Ingrese el nombre del estado" value="{{$tipo_jucio->nombre_tipo_juicio}}" required>
                @if($errors->has('nombre_tipo_juicio')) 
                  <p class="text-danger">{{$errors->first('nombre_tipo_juicio')}}</p>

                @endif
              </div>
              
            </div>
            <!-- /.box-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          
          <button type="submit" class="btn btn-outline"> Editar Tipo Jucio</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </form>
  </div>
        <!-- /.modal -->