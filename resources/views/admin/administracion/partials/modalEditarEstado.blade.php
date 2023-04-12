<!-- /.modal -->

<div class="modal modal-info fade" id="modal-info{{$estado->id}}">
  <form  method="POST" action="{{route('estados.update',$estado)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('PUT')
    @csrf 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar Estado</h4>
        </div>
        <div class="modal-body">

          
          <div class="box-body">
              <div class="form-group">
                <label for="nombre">Estado</label>
                <input type="text" class="form-control" name="nombre_estado" id="nombre_estado" placeholder="Ingrese el nombre del estado" value="{{$estado->nombre_estado}}" required>
                @if($errors->has('nombre_estado')) 
                  <p class="text-danger">{{$errors->first('nombre_estado')}}</p>

                @endif
              </div>
              
            </div>
            <!-- /.box-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          
          <button type="submit" class="btn btn-outline"> Editar Estado</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </form>
  </div>
        <!-- /.modal -->