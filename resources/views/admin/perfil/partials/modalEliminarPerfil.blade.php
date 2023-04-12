<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$perfil->id}}">
  <form  method="POST" action="{{route('perfiles.destroy',$perfil->id)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar el perfil siguiente:</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Persona: </strong>@if(isset($perfil->persona))
                      {{$perfil->persona->nombres_persona}} {{$perfil->persona->apellidos_persona}} 
                      @else
                        no ha seleccionado a una persona para el perfil con el perfil id
                        {{$perfil->id}}
                      @endif<br>
             <strong>Antecedentes penales: </strong> 
             @if($perfil->antecedentes_penales)
             No <br>
             @else
             Si <br>
             @endif
             @if(!is_null($perfil->picture))
             <strong>Imagen: </strong> <br>
             <img src="{{$perfil->picture}}" class="direct-chat-img"><br>
             @endif
             
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Perfil</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->