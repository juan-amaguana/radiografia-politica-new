 
 <table>
  <thead>
    <tr>
      <th style="border: 36px solid black; width: 30px"> <strong>Inmuelbles</strong> </th>
      <th style="border: 36px solid black; width: 20px"> <strong>Vehiculos</strong> </th>
      <th style="border: 36px solid black; width: 20px"> <strong>Patrimonio</strong> </th>
      <th style="border: 36px solid black; width: 20px"> <strong>Companias</strong> </th>
      
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$patrimonio->numero_casas}}</td>
      <td>{{$patrimonio->numero_carros}}</td>
      <td>${{$patrimonio->dinero}}</td>
      <td>{{$patrimonio->numero_companias}}</td>
    </tr>

  </tbody>
 </table>

 <br><br>

 <table>
  <tr>
    <th><strong>Fecha declaración:</strong> </th>
    <td>{{$patrimonio->fecha_declaracion}}</td>
  </tr>
  <tr>
    <th><strong>Activos:</strong></th>
    <td>{{$patrimonio->activos}}</td>
  </tr>
  <tr>
    <th><strong>Pasivos:</strong></th>
    <td>{{$patrimonio->pasivos}}</td>
  </tr>
  <tr>
    <th><strong>Patrimonio:</strong></th>
    <td>{{$patrimonio->patrimonio}}</td>
  </tr>
</table>



