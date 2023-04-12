<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$administracion->id}}">
  <form  method="POST" action="{{route('administraciones.destroy',$administracion->id)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la administracion siguiente:</h4>
          </div>
          <div class="modal-body">
            <p>
              <strong>Quienes somos: </strong>{!! $administracion->mision !!} <br>
              <strong>Imagen 1: </strong> <br><img src="/storage/administracion/imagen1/{{$administracion->imagen1}}" class="direct-chat-img"><br><br>
              <strong>Imagen 2: </strong> <br><img src="/storage/administracion/imagen2/{{$administracion->imagen2}}" class="direct-chat-img"><br><br>
              <strong>Imagen 3: </strong> <br><img src="/storage/administracion/imagen3/{{$administracion->imagen3}}" class="direct-chat-img"><br><br>
              <strong>Key word: </strong>{{ $administracion->key_word }} <br>
              <strong>Email: </strong>{{ $administracion->email }} <br>
              <strong>Teléfono: </strong>{{ $administracion->telefono }} <br>
              <strong>Dirección: </strong>{{ $administracion->direccion }} <br>
              <strong>Licencia: </strong>{{ $administracion->licencia }} <br>
              <strong>Autor datos abiertos: </strong>{{ $administracion->autor_datos_abiertos }} <br>
              <strong>Email Contacto datos abiertos: </strong>{{ $administracion->email_contacto_datos_abiertos }} <br>
              

             
             
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Adinistracion</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->