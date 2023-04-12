<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$actividad->id}}">
  <form  method="POST" action="{{route('actividades.destroy',$actividad)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la siguiente actividad</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Persona: </strong>{{$actividad->persona->nombres_persona}} {{$actividad->persona->apellidos_persona}} <br>
             <strong>Tipo actividad: </strong>{{$actividad->tipoActividad->nombre_tipo_actividad}} <br>
             <strong>Posición actividad: </strong>@if(isset($actividad->posicion))
                      {{$actividad->posicion->nombre_posicion}}
                      @else
                        Actividad sin posició
                      @endif <br>
             <strong>Fuente actividad: </strong>{{$actividad->fuente_actividad}} <br>
             <strong>Actividad actual: </strong>@if($actividad->posicion_actual==0)
                        No
                      @else
                        Si
                      @endif <br>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Actividad</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->