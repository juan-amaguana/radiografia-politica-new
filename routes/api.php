<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/perfil-actividades/{perfil_id}', 'PersonaController@perfilActividades');

Route::get('/personas', 'PersonaController@personasApi');

Route::get('/persona/{persona_id}', 'PersonaController@personaApi');

Route::get('/persona-detalle', 'PersonaController@personaDetalleApi');

Route::get('/personas-partidos-politicos', 'GraficasRadiografiaPoliticaController@personaPartidosPoliticos');

Route::get('/personas-estudios/{partido_politico}', 'GraficasRadiografiaPoliticaController@personaEstudios');

Route::get('/sexo/personas-partidos-politicos/{partido_politico}', 'GraficasRadiografiaPoliticaController@personasSexosPartidosPoliticos');

Route::get('/posiciones-cargos', 'GraficasRadiografiaPoliticaController@posicionesCargosApi');

Route::get('/personas-cargos', 'PosicionController@obtenerPersonasCargo');

Route::get('/provincia/{provincia_id}/cantones', 'ActividadController@obtenerCantones');

Route::get('/canton/{canton_id}/parroquias', 'ActividadController@obtenerParroquias');

Route::get('/patrimonio/{anio}', 'PatrimonioController@patrimonioGrafica');

Route::get('/sri/{anio}', 'SriController@sriGrafica');

Route::get('/perfiles-mas-visitados', 'PersonaController@visitasPerfiles');

Route::get('/most-visited', 'PersonaController@mostVisited');

/*nuevas rutas graficas*/
Route::get('/funciones-estado', 'FuncionEstadoController@funcionesEstado');

Route::get('/instituciones-independientes', 'FuncionEstadoController@institucionesIndependientes');

Route::get('/genero-funcion-judicial/{funcion_estado}', 'PersonaController@generoPersonaFuncionEstado');

Route::get('/detalle-genero-funcion-judicial/{funcion_estado}/{genero_persona}', 'PersonaController@detalleGeneroPersonaFuncionEstado');

Route::get('/genero-funcion-judicial-todos', 'PersonaController@generoPersonaFuncionEstadoTodos');

Route::get('/todos-detalle-genero-funcion-judicial/{genero_persona}', 'PersonaController@detalleTodosGeneroPersonaFuncionEstado');

Route::get('/formacion-academica/{funcion_estado}', 'EstudioController@formacionAcademica');

Route::get('/formacion-academica-todos', 'EstudioController@formacionAcademicaTodos');

Route::get('/patrimonios-funcion-estado/{function_estado}', 'PatrimonioController@obtenerPatrimoniosFuncionEstado');

Route::get('/patrimonios-todos', 'PatrimonioController@obtenerPatrimoniosFuncionEstadoTodos');

//Route::get('/patrimonios-funcion-estado-todos/{rango}','PatrimonioController@obtenerPatrimoniosFuncionEstadoTodos');

Route::get('/patrimonios-funcion-estado-todos-nuevo', 'PatrimonioController@rangoPatrimoniosTodos');

Route::get('/patrimonios-funcion-estado-rango/{function_estado}/{rango}', 'PatrimonioController@obtenerPatrimoniosRangoFuncionEstado');

Route::get('/patrimonios-funcion-estado-rango-nuevo/{function_estado}', 'PatrimonioController@rangoPatrimonio');

Route::get('/patrimonios-funcion-estado-rango-todos/{rango}', 'PatrimonioController@obtenerPatrimoniosTodosRangoFuncionEstado');

Route::get('/sri-renta-rango-funcion-estado/{function_estado}/{rango}', 'SriController@obtenerSriRangoFuncionEstado');

Route::get('/sri-renta-rango-funcion-estado-nuevo/{function_estado}', 'SriController@obtenerPorcentajeSriRangoFuncionEstado');

Route::get('/sri-renta-rango-funcion-estado-todos/{rango}', 'SriController@obtenerSriRangoTodosFuncionEstado');

Route::get('/sri-renta-rango-funcion-estado-todos-nuevo', 'SriController@obtenerSriRangoTodos');

Route::get('/sri-renta-funcion-estado/{function_estado}/{anio}', 'SriController@obtenerSriFuncionEstado');

Route::get('/sri-renta-funcion-estado-todos/{anio}', 'SriController@obtenerSriFuncionEstadoTodos');

Route::get('/profesiones/{funcion_estado}', 'EstudioController@obtenerProfesionales');

Route::get('/profesiones-todos', 'EstudioController@obtenerProfesionalesTodos');

Route::get('/profesiones-personas/{profesion}/{funcion_estado}', 'EstudioController@obtenerProfesionalesPersona');

Route::get('/profesiones-personas-todos/{profesion}', 'EstudioController@obtenerProfesionalesPersonaTodos');

Route::get('/profesiones-personas-area/{funcion_estado}', 'EstudioController@obtenerProfesionalesArea');

Route::get('/detalle-profesiones-personas-area-estudio/{funcion_estado}/{area_estudio_id}', 'EstudioController@obtenerDetalleProfesionalesArea');

Route::get('/detalle-profesiones-personas-area/{funcion_estado}/{tipo_titulo}', 'EstudioController@obtenerPersonasProfesionalesArea');

Route::get('/profesiones-personas-area-todos', 'EstudioController@obtenerProfesionalesAreaTodos');

Route::get('/detalle-profesiones-personas-area-estudios-todos/{area_estudio_id}', 'EstudioController@getDetalleProfesionalesAreaTodos');

Route::get('/detallel-profesiones-personas-area-todos/{tipo_estudio}', 'EstudioController@obtenerDetalleProfesionalesAreaTodos');

Route::get('/json-metadata-datos-abiertos', 'AdministracionController@obtenerMetaDatos');

/*fun rutas graficas*/

/*inicio api*/
Route::get('/json-genero', 'ExportApiController@jsonGenero');

Route::get('/json-patrimonio', 'ExportApiController@jsonPatrimonio');

Route::get('/json-sri', 'ExportApiController@jsonSri');

Route::get('/json-estudio', 'ExportApiController@jsonEstudio');
/*Fin api*/