
@include('exports.include.meta_datos')
<h3>Datos</h3>
<table>
    <thead>
    <tr>
        <th style="width: 30px; border: 36px solid black"> <strong>id</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Nombre</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Género</strong> </th>
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
            <td>

                @if($persona->genero_persona == 0)
                    Mujer
                @else
                    Hombre
                @endif

            </td>
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