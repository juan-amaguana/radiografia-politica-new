<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$compania->id}}">
  <form  method="POST" action="{{route('companias.destroy',$compania)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la siguiente posicion</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre compania: </strong>@if(isset($compania->nombre_compania))
                      {{$compania->nombre_compania}}
                      @else
                        no se registro nombre de la empresa
                      @endif <br>
             <strong>Usuario: </strong>@if(isset($compania->perfil->persona))
                      {{$compania->perfil->persona->nombres_persona}} {{$compania->perfil->persona->apellidos_persona}} 
                      @else
                        no existe persona
                        {{$compania->perfil->id}}
                      @endif <br>
             <strong>posicion compania: </strong>{{$compania->posicion_compania}} <br>
             
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar compania</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->