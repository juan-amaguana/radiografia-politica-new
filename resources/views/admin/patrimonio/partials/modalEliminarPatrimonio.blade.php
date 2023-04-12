<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$patrimonio->id}}">
  <form  method="POST" action="{{route('patrimonios.destroy',$patrimonio)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar el siguiente patrimonio</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Usuario: </strong>

             {{$patrimonio->perfil->persona->nombres_persona}} {{$patrimonio->perfil->persona->apellidos_persona}} <br>
            
             
              
            
             <strong>Activos: </strong>{{$patrimonio->activos}} <br>
             <strong>Pasivos: </strong>{{$patrimonio->pasivos}} <br>
             <strong>Patrimonio: </strong>{{$patrimonio->patrimonio}} <br>
             <strong>Fecha declaración: </strong>{{$patrimonio->fecha_declaracion}} <br>
             
              <br>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar patrimonio</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->