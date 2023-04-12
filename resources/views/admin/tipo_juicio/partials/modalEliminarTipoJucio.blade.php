<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$tipo_jucio->id}}">
  <form  method="POST" action="{{route('tipoJucios.destroy',$tipo_jucio)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar el siguiente tipo jucio</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre tipo jucio: </strong>{{$tipo_jucio->nombre_tipo_juicio}}
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Estado</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->