<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$partido_politico->id}}">
  <form  method="POST" action="{{route('partidosPoliticos.destroy',$partido_politico)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar el siguiente estado</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre partido politico: </strong>{{$partido_politico->nombre_partido_politico}} <br>
             <strong>Imagen partido politico: </strong><br><img src="{{$partido_politico->imagen_partido_politico}}" class="direct-chat-img">
              <br>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar partido politico</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->