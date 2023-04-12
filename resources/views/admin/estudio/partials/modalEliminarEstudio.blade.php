<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger{{$estudio->id}}">
  <form  method="POST" action="{{route('estudios.destroy',$estudio)}}" class="form-horizontal" data-parsley-validate="true" name="demo-form">
    @method('DELETE')
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Usted desea eliminar la siguiente Estudio</h4>
          </div>
          <div class="modal-body">
            <p>
            <strong>Usuario: </strong>{{$estudio->perfil->persona->nombres_persona}} {{$estudio->perfil->persona->apellidos_persona}} <br>
             <strong>Profesion: </strong>{{$estudio->profesion_estudio}} <br>
             
             <strong>Pregrado: </strong>@if($estudio->pregrado_estudio==0) Sin títulos @else {{$estudio->pregrado_estudio}} @endif<br>
             <strong>posgrado: </strong>@if($estudio->posgrado_estudio==0) Sin títulos @else {{$estudio->posgrado_estudio}} @endif<br>
             <strong>PHD: </strong>@if($estudio->phd_estudio==0) Sin títulos @else {{$estudio->phd_estudio}} @endif<br>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline"> Eliminar Estudio</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
        <!-- /.modal -->