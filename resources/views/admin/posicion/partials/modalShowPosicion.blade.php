<!-- /.modal -->

<div class="modal modal-info fade" id="modal-info{{$posicion->id}}">
  
   
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Información posición</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre posición: </strong>{{$posicion->nombre_posicion}} <br>

             <strong>Función:</strong>
             @if(isset($posicion->funcion_estado))
                        {{$posicion->funcion_estado->nombre}}
                        
                      @else
                        Sin registro
                      @endif
                      <br>
             <strong>Tipo posición: </strong>
             @if(isset($posicion->funcion_estado))
                        @if($posicion->funcion_estado->categoria == 0)
                        Función estado <br>
                        <strong>Estandarización posicion:</strong>
             @if(!is_null($posicion->categoria_id))
              {{$posicion->categoria->nombre_categoria}}
             @else
              Sin registro
             @endif
             <br>
                        @else
                        Institución independiente
                        @endif
                      @else
                        Sin registro
                      @endif
            <br>        
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  
</div>
        <!-- /.modal -->