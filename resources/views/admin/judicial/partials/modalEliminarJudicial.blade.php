<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$judicial->id}}">
  <form  method="POST" action="{{route('judiciales.destroy',$judicial)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
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
             <strong>Judicial: </strong>{{$judicial->nombre_judicial}} <br>
             <strong>Usuario: </strong>{{$judicial->perfil->persona->nombres_persona}} {{$judicial->perfil->persona->apellidos_persona}} <br>
             <strong>Tipo Judicial: </strong>{{$judicial->tipoJuicio->nombre_tipo_juicio}} <br>
             <strong>Numero Judicial: </strong>{{$judicial->numero_judicial}}
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