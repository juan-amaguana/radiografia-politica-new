
@include('exports.include.meta_datos')
<h3>Datos</h3>
<table>
    <thead>
    <tr>
        <th style="width: 30px; border: 36px solid black"> <strong>id</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Nombre</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Fecha declaración patrimonio </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Número de casas </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Número de carros </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Número de companias </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Activos</strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Pasivos</strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Patrimonio</strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Cargo</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Categoría</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Función</strong> </th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($datos_api as $persona)
        <tr>
            <td>{{$persona->persona_id}}</td>
            <td>{{$persona->nombres_persona." ".$persona->apellidos_persona}}</td>
            <td>{{$persona->fecha_declaracion}}</td>
            <td>{{$persona->numero_casas}}</td>
            <td>{{$persona->numero_carros}}</td>
            <td>{{$persona->numero_companias}}</td>
            <td>{{$persona->activos}}</td>
            <td>{{$persona->pasivos}}</td>
            <td>{{$persona->patrimonio}}</td>
            <td>{{$persona->cargo}}</td>
            <td>
                @if($persona->categoria == 0)
                    Función Estado
                @else
                    Institucion Independiente
                @endif

            </td>
            <td>{{$persona->funcion}}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>