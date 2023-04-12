<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$penal->id}}">
  <form  method="POST" action="{{route('penales.destroy',$penal)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
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
             <strong>Penal: </strong>{{$penal->nombre_penal}} <br>
             <strong>Usuario: </strong>{{$penal->perfil->persona->nombres_persona}} {{$penal->perfil->persona->apellidos_persona}} <br>
             <strong>Tipo Penal: </strong>{{$penal->tipoJuicio->nombre_tipo_juicio}} <br>
             <strong>Total Penal: </strong>{{$penal->total_penal}}
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Penal</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->