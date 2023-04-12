 
 <table>
  <thead>
    <tr>
      <th style="border: 36px solid black; width: 30px"> <strong>Numero companias</strong> </th>
      <th style="border: 36px solid black; width: 30px"> <strong>Puesto</strong> </th>
      
    </tr>
  </thead>
  <tbody>
    @if(count($compania_presidente)>0)
    
    <tr>
      <td>{{count($compania_presidente)}}</td>
      <td>Presidente</td>
    </tr>
    
    @endif

    @if(count($compania_gerente)>0)
    
    <tr>
      <td>{{count($compania_gerente)}}</td>
      <td>Gerente</td>
    </tr>
    
    @endif

    @if(count($compania_accionista)>0)
    
    <tr>
      <td>{{count($compania_accionista)}}</td>
      <td>Accionista</td>
    </tr>
    
    @endif

  </tbody>
 </table>


