<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$candidatura->id}}">
  <form  method="POST" action="{{route('candidaturas.destroy',$candidatura)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la siguiente concurso</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre concurso: </strong>{{$candidatura->nombre_candidatura}} <br>
             <strong>Posición concurso: </strong>@if(!is_null($candidatura->posicion_id))
                      {{$candidatura->posicion->nombre_posicion}}
                      @else
                      Sin registro
                      @endif <br>
             <strong>Fecha inicio: </strong>{{$candidatura->fecha_inicio_candidatura}} <br>
             <strong>Fecha fin: </strong>{{$candidatura->fecha_fin_candidatura}} <br>
             <strong>Estado concurso: </strong>
             @if($candidatura->candidatura_abierta==0)
             Concurso Cerrado
             @else
             Concurso Abierto
             @endif
             <br>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar concurso</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->