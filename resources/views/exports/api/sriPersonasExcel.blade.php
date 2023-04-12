
@include('exports.include.meta_datos')
<h3>Datos</h3>
<table>
    <thead>
    <tr>
        <th style="width: 30px; border: 36px solid black"> <strong>id</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Nombre</strong> </th>
        <th style="width: 35px; border: 36px solid black"> <strong>Año declaración impuesto </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Tipo impuesto </strong></th>
        <th style="width: 35px; border: 36px solid black"> <strong>Valor impuesto</strong></th>
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
            <td>{{$persona->anio_declaracion}}</td>
            <td>

                @if($persona->tipo_impuesto_sri==2)
                    Impuesto a la renta
                @else
                    Impuesto divisas
                @endif
                

            </td>
            <td>{{$persona->valor_impuesto_sri}}</td>
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