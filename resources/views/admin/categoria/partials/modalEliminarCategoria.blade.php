<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$categorias->id}}">
  <form  method="POST" action="{{route('categorias.destroy',$categorias)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la siguiente categoría</h4>
          </div>
          <div class="modal-body">
            <p>
             <strong>Nombre: </strong>{{$categorias->nombre_categoria}} <br>

             <strong>Meta descripción:</strong>{{$categorias->nombre_categoria}}<br>
             <strong>Key Word:</strong>{{$categorias->meta_keywords}}<br>
             <strong>Slug:</strong>{{$categorias->slug}}<br>
              <strong>Estado:</strong>
             @if($categorias->estado==1)
                        <small class="label label-success"><i class="fa fa-clock-o"></i> Activo</small>
                      @else
                        <small class="label label-warning"><i class="fa fa-clock-o"></i> Inactivo</small>
                      @endif <br>
             
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Categoría</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->