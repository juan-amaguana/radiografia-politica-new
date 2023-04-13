<!-- Modal Renta -->
<div id="modal_declaracion" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h5 class="fcd-custom-color">Declaración de Bienes</h5>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <table class="highlight fcd-custom-color">
            <thead>
              <tr>
                  <th>Activos</th>
                  <th>Pasivos</th>
                  <th>Patrimonio</th>
                  <th>Inmuebles</th>
                  <th>Vehículos</th>
                  <th>Fecha declaración</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($patrimonios as $patrimonio)
              <tr>
                  <td>{{ $patrimonio->activos }}</td>
                  <td>{{ $patrimonio->pasivos }}</td>
                  <td>{{ $patrimonio->patrimonio }}</td>
                  <td>{{ $patrimonio->numero_casas }}</td>
                  <td>{{ $patrimonio->numero_carros }}</td>
                  <td>{{ $patrimonio->fecha_declaracion }}</td>
              </tr>
              @endforeach
            /perfil/1139</tbody>
          </table>

      </div>
      <div class="col-md-2"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
  </div>

