<h3>Metadatos</h3>
  

  <table>
  <tr>
    <th>Email contacto datos abiertos:</th>
    <td>{{$api_radiografia_politica['metaDatos']->email_contacto_datos_abiertos}}</td>
  </tr>
  <tr>
    <th>Autor datos abiertos:</th>
    <td>{{$api_radiografia_politica['metaDatos']->autor_datos_abiertos}}</td>
  </tr>
  <tr>
    <th>Licencia datos abiertos:</th>
    <td>{{$api_radiografia_politica['metaDatos']->licencia}}</td>
  </tr>
</table>
<h3>Datos</h3>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>descripcion_cargo</th>
        <th>cargo</th>
        <th>orden</th>
        <th>picture</th>
        <th>partido</th>
        <th>facebook</th>
        <th>twitter</th>
        <th>description</th>
        <th>description_persona</th>
        <th>name</th>
        <th>lastname</th>
        <th>img</th>
        <th>funcion_estado_id</th>
        <th>funcion_estado</th>
        <th>estado_cargo</th>
        <th>institucion</th>
        <th>es_candidato</th>
    </tr>
    </thead>
    <tbody>
    @foreach($api_radiografia_politica['datos'] as $persona)
        <tr>
            <td>{{$persona->id}}</td>
            <td>{{$persona->descripcion_cargo}}</td>
            <td>{{$persona->cargo}}</td>
            <td>{{$persona->orden}}</td>
            <td>{{$persona->picture}}</td>
            <td>{{$persona->partido}}</td>
            <td>{{$persona->facebook}}</td>
            <td>{{$persona->twitter}}</td>
            <td>{{$persona->description}}</td>
            <td>{{$persona->description_persona}}</td>
            <td>{{$persona->name}}</td>
            <td>{{$persona->lastname}}</td>
            <td>{{$persona->img}}</td>
            <td>{{$persona->funcion_estado_id}}</td>
            <td>{{$persona->funcion_estado}}</td>
            <td>{{$persona->estado_cargo}}</td>
            <td>{{$persona->institucion}}</td>
            <td>{{$persona->es_candidato}}</td>
        </tr>
    @endforeach
    </tbody>
</table>