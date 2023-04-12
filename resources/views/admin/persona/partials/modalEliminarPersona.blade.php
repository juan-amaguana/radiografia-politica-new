<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger">
  <form  method="POST" action="{{route('personas.destroy',$persona)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar persona</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="persona_id" id="persona-id" value="">
            <p>Usted esta seguro de eliminar la persona?</p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Persona</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->