<?php

// use Illuminate\Support\Facades\Input;
// use Illuminate\Http\Request;
// use App\Models\politico;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'PersonaController@home');
Route::get('/perfil/{id}', 'PersonaController@perfil')->name('perfil-post');

Route::get('/cargos', 'GraficasRadiografiaPoliticaController@posicionesCargosApi');

Route::get('/datos-abiertos', 'PaginaController@datos_abiertos');

Route::get('/quieres-ser-colaborador', 'PaginaController@sumateIniciativa');

Route::get('/sumate-a-la-iniciativa', 'PaginaController@colaborador');

Route::get('/politico-detalle/{politico_id}', 'ExportPersonas@exportarPolitico');

Route::get('/politico-detalle-csv/{politico_id}', 'ExportPersonas@exportarPoliticoCsv');

Route::get('/contactanos', 'PaginaController@contacto');

Route::post('/mensaje', 'ContactoController@store');

Route::post('/sumate-iniciativa-funcionario', 'SumateIniciativaController@store');

Route::post('/sumate-iniciativa-funcionario/vista-previa', 'SumateIniciativaController@vistaPreviaExcel');

Route::get('/personas-list-excel', 'ExportPersonas@exportExcel')->name('personas.excel');

Route::get('/personas-list-csv', 'ExportPersonas@exportCsv')->name('personas.csv');

// Route::get('api/listadopoliticos', function(){
//   //return politico::all();
//
//   $politicos = DB::table('people')
//             ->select('people.*','politicalparties.name as partido','profiles.picture', 'positions.name as cargo')
//             ->leftJoin('politicalparties', 'people.politicalParty_id', '=', 'politicalparties.id')
//             ->leftJoin('profiles', 'people.profile_id', '=', 'profiles.id')
//             ->leftJoin('positions', 'people.position_id', '=', 'positions.id')
//             ->distinct()
//             ->get();
//
//   return $politicos;
//
// });

// Route::get('api/listadopoliticos/{id}', function($id){
//
//   $politicos = DB::table('people')
//             ->select('people.*','politicalparties.name as partido','profiles.picture', 'positions.name as cargo')
//             ->leftJoin('politicalparties', 'people.politicalParty_id', '=', 'politicalparties.id')
//             ->leftJoin('profiles', 'people.profile_id', '=', 'profiles.id')
//             ->leftJoin('positions', 'people.position_id', '=', 'positions.id')
//             ->where('profile_id', $id)
//             ->distinct()
//             ->get();
//
//   return $politicos;
//
// });

//Limpiar
Route::get('/clear-cache', function () {
    //$exitCode = Artisan::call('cache:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

});

Auth::routes();

/*Inicio nuevas graficas*/
Route::get('/grafica-patrimonio-funcion-estado', 'GraficasRadiografiaPoliticaController@graficaPatrimonioFuncionEstado');

Route::get('/grafica-patrimonio-rango', 'GraficasRadiografiaPoliticaController@graficaPatrimonioRangoFuncionEstado');

Route::get('/grafica-impuesto-renta-funcion-estado', 'GraficasRadiografiaPoliticaController@graficaImpuestoRentaFuncionEstado');

Route::get('/grafica-impuesto-renta-rango', 'GraficasRadiografiaPoliticaController@graficaImpuestoRentaRangoFuncionEstadoNuevo');

Route::get('/grafica-genero', 'GraficasRadiografiaPoliticaController@graficaGeneroFuncionEstado');

Route::get('/grafica-formacion-academica', 'GraficasRadiografiaPoliticaController@graficaFormacionAcademica');

Route::get('/grafica-formacion-academica-area', 'GraficasRadiografiaPoliticaController@graficaFormacionAcademicaArea');
/*Fin nuevas graficas*/

Route::get('/grafica-cargos-posiciones', 'GraficasRadiografiaPoliticaController@graficasCargosPosiciones');

Route::get('/grafica-profesionales', 'GraficasRadiografiaPoliticaController@graficasProfesionales');

Route::get('/grafica-patrimonio', 'GraficasRadiografiaPoliticaController@graficaPatrimonio');

Route::get('/grafica-sri', 'GraficasRadiografiaPoliticaController@graficaSri');

Route::get('/grafica-perfiles-visitados', 'GraficasRadiografiaPoliticaController@graficasVisitasPerfil');

Route::get('/graficas-radiografia-politica', 'GraficasRadiografiaPoliticaController@graficas');

Route::get('/posiciones', 'GraficasRadiografiaPoliticaController@posiciones');

Route::get('/posiciones-politicas', 'GraficasRadiografiaPoliticaController@posicionesPoliticas');

Route::get('/quienes-somos', 'PaginaController@quienesSomos');

/*Inicio Api*/
Route::get('/excel-genero', 'ExportApiController@excelGenero');
Route::get('/csv-genero', 'ExportApiController@csvGenero');

Route::get('/excel-patrimonio', 'ExportApiController@excelPatrimonio');
Route::get('/csv-patrimonio', 'ExportApiController@csvPatrimonio');

Route::get('/excel-sri', 'ExportApiController@excelSri');
Route::get('/csv-sri', 'ExportApiController@csvSri');

Route::get('/excel-estudio', 'ExportApiController@excelEstudio');
Route::get('/csv-estudio', 'ExportApiController@csvEstudio');
/*Fin Api*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categorias', 'CategoriaController');

    Route::resource('tipo_delitos', 'TipoDelitoController');

    Route::resource('estados', 'EstadoController');

    Route::resource('perfiles', 'PerfilController');

    Route::resource('partidosPoliticos', 'PartidoPoliticoController');

    Route::resource('personas', 'PersonaController');

    Route::resource('posiciones', 'PosicionController');

    Route::resource('actividades', 'ActividadController');

    Route::resource('patrimonios', 'PatrimonioController');

    Route::resource('companias', 'CompaniaController');

    Route::resource('sri', 'SriController');

    Route::resource('tipoJucios', 'TipoJuicioController');

    Route::resource('judiciales', 'JudicialController');

    Route::resource('penales', 'PenalController');

    Route::resource('estudios', 'EstudioController');

    Route::resource('administraciones', 'AdministracionController');

    Route::resource('candidaturas', 'CandidaturaController');

    Route::resource('postulantesCandidaturas', 'PostulanteCandidaturaController');

    Route::get('/contactos-radiografia-politica', 'ContactoController@index');

    Route::get('/mensaje-detalle/{contato_id}', 'ContactoController@show');

    Route::get('/funcionarios-excel', 'ExcelImportController@index');

    Route::get('/ver-excel-funcionario', 'ExcelImportController@detalleFUncionarioExcel');

    Route::get('/funcionarios-excel', 'ExcelImportController@index');

    Route::get('/ver-excel-funcionario', 'ExcelImportController@detalleFUncionarioExcel');

    Route::get('/sumate-iniciativa', 'SumateIniciativaController@index');

    Route::get('/detalle-iniciativa/{id}', 'SumateIniciativaController@show');

    Route::post('/guardar-iniciativa', 'SumateIniciativaController@store');
});

Route::get('/docs/curriculum/{archivo}', 'ArchivosDownloadController@descargarCurriculum');

//Route::get('/cambiar-string', 'ArchivosDownloadController@cambiar');

Route::get('/docs/plan/{archivo}', 'ArchivosDownloadController@descargarPlan');

Route::get('/docs/fuentes/{archivo}', 'ArchivosDownloadController@descargarFuente');

Route::get('/docs/patrimonio/{archivo}', 'ArchivosDownloadController@descargarPatrimonio');
