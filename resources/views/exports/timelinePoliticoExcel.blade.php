
 <table>
 	<thead>
 		<tr>
 			<th style="border: 36px solid black"> <strong>Año inicio</strong> </th>
 			<th style="border: 36px solid black"> <strong>Año fin</strong> </th>
 			<th style="width: 75px; border: 36px solid black"> <strong>Titulo actividad</strong> </th>
 			<th style="width: 100px; border: 36px solid black"> <strong>Descripción actividad</strong> </th>
 			<th style="border: 36px solid black"> <strong>Tipo Actividad</strong> </th>
 		</tr>
 	</thead>

 	<tbody>
 		@if(count($actividades_publica)>0)

 		@foreach($actividades_publica as $actividad_publica)
 		<tr>
 			<td>{{$actividad_publica->anio_inicio}}</td> 
 			<td>{{$actividad_publica->anio_fin}}</td>
 			<td>{!!$actividad_publica->descripcion_corta!!}</td>
 			<td style="height: 30px">{!!$actividad_publica->descripcion!!}</td>
 			<td>Actividad Pública</td>
 		</tr>
 		@endforeach
 		@endif


 		@if(count($actividades_privada)>0)
 		@foreach($actividades_privada as $actividad_privada)
 		<tr>
 			<td>{{$actividad_privada->anio_inicio}}</td> 
 			<td>{{$actividad_privada->anio_fin}}</td>
 			<td>{{$actividad_privada->descripcion_corta}}</td>
 			<td style="height: 30px">{!!$actividad_privada->descripcion!!}</td>
 			<td>Actividad Privada</td>
 		</tr>
 		@endforeach
 		@endif

 		@if(count($actividades_politica)>0)
 		@foreach($actividades_politica as $actividad_politica)
 		<tr>
 			<td>{{$actividad_politica->anio_inicio}}</td>
 			<td>{{$actividad_politica->anio_fin}}</td>
 			<td>{!!$actividad_politica->descripcion_corta!!}</td>
 			<td style="height: 30px">{!!$actividad_politica->descripcion!!}</td>
 			<td>Actividad Política</td>
 		</tr>
 		@endforeach
 		@endif
			
 	</tbody>
 </table>
