 <h4>SRi a la Renta</h4>
 <table>
  <thead>
    <tr>
      <th style="border: 36px solid black"> <strong>Año</strong> </th>
      <th style="border: 36px solid black"> <strong>Impuesto</strong> </th>
      
    </tr>
  </thead>
  <tbody>
    @if(count($sri_rentas))
    @foreach($sri_rentas as $sri_renta)
    <tr>
      <td>{{$sri_renta->anio_sri}}</td>
      <td>{{$sri_renta->valor_impuesto_sri}}</td>
    </tr>
    @endforeach
    @endif


  </tbody>
 </table>
<br><br><br>
 <h4>SRi Divisas</h4>

 <table>
  <thead>
    <tr>
      <th style="border: 36px solid black"> <strong>Año</strong> </th>
      <th style="border: 36px solid black"> <strong>Impuesto</strong> </th>
      
    </tr>
  </thead>
  <tbody>
    @if(count($sri_divisas))
    @foreach($sri_divisas as $sri_divisa)
    <tr>
      <td>{{$sri_divisa->anio_sri}}</td>
      <td>{{$sri_divisa->valor_impuesto_sri}}</td>
    </tr>
    @endforeach
    @endif


  </tbody>
 </table>