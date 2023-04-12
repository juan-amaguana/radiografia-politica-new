<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use App\Models\Estudio;
use App\Models\Patrimonio;
use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Sri;
use App\Models\SumateIniciativa;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use Storage;

class SumateIniciativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumate_iniciativas = SumateIniciativa::all();

        return view('admin.sumate_iniciativa.index')->with(['sumate_iniciativas' => $sumate_iniciativas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sumate_iniciativa = SumateIniciativa::find($request->id_iniciativa);
        if ($request->si_guarda == 1) {
            $persona = $this->registrarFuncionarioIniciativa($request);
            $perfil  = $this->registrarPerfilIniciativa($request, $persona);
            $this->registrarPatrimonioIniciativa($request, $perfil);
            $this->registrarSriIniciativa($request, $perfil);
            $this->registrarCompaniasIniciativa($request, $perfil);
            flash('La iniciativa con id' . $sumate_iniciativa->id . 'del colaborador ' . $sumate_iniciativa->nombre_aportante . ' ha sido ingresada a la base de datos.')->success();
        } else {
            flash('La iniciativa con id ' . $sumate_iniciativa->id . ' del colaborador ' . $sumate_iniciativa->nombre_aportante . ' ha sido rechazada.')->error();
            //$this->actualizarIniciativa();
        }
        $secciones_funcionario = $request->seccion_funcionario;

        return redirect('/admin/sumate-iniciativa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SumateIniciativa  $sumateIniciativa
     * @return \Illuminate\Http\Response
     */
    public function show($iniciativa_id)
    {
        $sumateIniciativa = SumateIniciativa::find($iniciativa_id);

        //OBJETO PERSONA
        $returns_persona = $this->personaExcel($sumateIniciativa->archivo_funcionario);
        $persona         = $returns_persona['persona'];

        //OBJETO PERFIL
        $returns_perfil = $this->perfilExcel($sumateIniciativa->archivo_funcionario);
        $perfil         = $returns_perfil['perfil'];

        //OBJETOS PATRIMONIOS
        $returns_patrimonios = $this->patrimonioExcel($sumateIniciativa->archivo_funcionario);
        $patrimonios         = $returns_patrimonios['patrimonios'];

        //OBJETOS SRIs RENTA
        $sris           = array();
        $returns_rentas = $this->sriRenta($sumateIniciativa->archivo_funcionario, $sris);
        $sris           = $returns_rentas['sris_coleccion'];

        //OBJETOS SRIs DIVISAS
        $returns_divisas = $this->sriDivisas($sumateIniciativa->archivo_funcionario, $sris);
        $sris            = $returns_divisas['sris_coleccion'];

        //OBJETO ESTUDIO
        $returns_estudio = $this->estudioExcel($sumateIniciativa->archivo_funcionario);
        $estudio         = $returns_estudio['estudio'];

        //OBJETOS COMPANIA
        $returns_companias = $this->companiasExcel($sumateIniciativa->archivo_funcionario);
        $companias         = $returns_companias['companias'];

        //dd($persona, $perfil, $patrimonios, $sris, $estudio, $companias);

        return view('admin.sumate_iniciativa.show')->with(['sumateIniciativa' => $sumateIniciativa, 'persona' => $persona, 'perfil' => $perfil, 'patrimonios' => $patrimonios, 'sris' => $sris, 'estudio' => $estudio, 'companias' => $companias]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SumateIniciativa  $sumateIniciativa
     * @return \Illuminate\Http\Response
     */
    public function edit(SumateIniciativa $sumateIniciativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SumateIniciativa  $sumateIniciativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SumateIniciativa $sumateIniciativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SumateIniciativa  $sumateIniciativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(SumateIniciativa $sumateIniciativa)
    {
        //
    }

    public function registrarCompaniasIniciativa($request, $perfil)
    {
        $returns_companias = $this->companiasExcel($request->nombre_archivo);
        $companias         = $returns_companias['companias'];
        foreach ($companias as $compania) {
            $compania->perfil_id = $perfil->id;
            $compania->user_id   = Auth::user()->id;
            $compania->save();
        }
    }

    public function registrarSriIniciativa($request, $perfil)
    {
        //OBJETOS SRIs RENTA
        $sris           = array();
        $returns_rentas = $this->sriRenta($request->nombre_archivo, $sris);
        $sris           = $returns_rentas['sris_coleccion'];

        //OBJETOS SRIs DIVISAS
        $returns_divisas = $this->sriDivisas($request->nombre_archivo, $sris);
        $sris            = $returns_divisas['sris_coleccion'];

        foreach ($sris as $sri) {
            $sri->perfil_id = $perfil->id;
            $sri->user_id   = Auth::user()->id;
            $sri->save();
        }

    }

    public function registrarPatrimonioIniciativa($request, $perfil)
    {
        $returns_patrimonios = $this->patrimonioExcel($request->nombre_archivo);
        $patrimonios         = $returns_patrimonios['patrimonios'];
        foreach ($patrimonios as $patrimonio) {
            $patrimonio->patrimonio = $patrimonio->activos - $patrimonio->pasivos;
            $patrimonio->perfil_id  = $perfil->id;
            $patrimonio->user_id    = Auth::user()->id;
            $patrimonio->save();
        }
    }
    public function registrarPerfilIniciativa($request, $persona)
    {
        $returns_perfil         = $this->perfilExcel($request->nombre_archivo);
        $perfil                 = $returns_perfil['perfil'];
        $perfil->url_sri        = 'https://srienlinea.sri.gob.ec/sri-en-linea/SriDeclaracionesWeb/ConsultaImpuestoRenta/Consultas/consultaImpuestoRenta';
        $perfil->url_patrimonio = 'https://www.contraloria.gob.ec/Consultas/DeclaracionesJuradas';
        $perfil->url_compania   = 'https://appscvsmovil.supercias.gob.ec/portaldeinformacion/consulta_cia_param.zul';
        $perfil->url_judicial   = 'http://consultas.funcionjudicial.gob.ec/informacionjudicial/public/informacion.jsf';
        $perfil->url_penal      = 'http://certificados.ministeriodegobierno.gob.ec/gestorcertificados/antecedentes/';
        $perfil->url_estudio    = 'http://www.senescyt.gob.ec/consulta-titulos-web/faces/vista/consulta/consulta.xhtml';
        $perfil->persona_id     = $persona->id;
        $perfil->user_id        = Auth::user()->id;
        $perfil->save();
        return $perfil;
    }
    public function registrarFuncionarioIniciativa($request)
    {
        $returns_persona          = $this->personaExcel($request->nombre_archivo);
        $persona                  = $returns_persona['persona'];
        $persona->twitter_persona = '@' . $persona->twitter_persona;
        $persona->user_id         = Auth::user()->id;
        $persona->estado_id       = 1;
        $persona->save();
        return $persona;
    }
    public function vistaPreviaExcel(Request $request)
    {
        $errores_excel = array();
        $file          = $request->file('archivo_funcionario'); //obtenemos el campo file definido en el formulario
        //$nombreArchivo = $file->getClientOriginalName(); //obtenemos el nombre del archivo
        $nombreArchivo = strtotime("now") . "-" . str_replace(" ", "_", $request->nombre_aportante) . '.' . $file->getClientOriginalExtension(); // agregamos la fecha actual unix al inicio del nombre del archivo
        Storage::disk('local')->put($nombreArchivo, \File::get($file)); //indicamos que queremos guardar un nuevo archivo en el disco local

        //OBJETO SUMATE A LA INICIATIVA
        $sumate_iniciativa                      = new SumateIniciativa;
        $sumate_iniciativa->nombre_aportante    = $request->nombre_aportante;
        $sumate_iniciativa->telefono_aportante  = $request->telefono_aportante;
        $sumate_iniciativa->email_aportante     = $request->email_aportante;
        $sumate_iniciativa->archivo_funcionario = $nombreArchivo;

        //OBJETO PERSONA
        $returns_persona = $this->personaExcel($nombreArchivo);
        $persona         = $returns_persona['persona'];
        $errores_excel   = $this->unificarErroresExcel($errores_excel, $returns_persona['errores']);

        //OBJETO PERFIL
        $returns_perfil = $this->perfilExcel($nombreArchivo);
        $perfil         = $returns_perfil['perfil'];
        $errores_excel  = $this->unificarErroresExcel($errores_excel, $returns_perfil['errores']);

        //OBJETOS PATRIMONIOS
        $returns_patrimonios = $this->patrimonioExcel($nombreArchivo);
        $patrimonios         = $returns_patrimonios['patrimonios'];
        $errores_excel       = $this->unificarErroresExcel($errores_excel, $returns_patrimonios['errores']);

        //OBJETOS SRIs RENTA
        $sris           = array();
        $returns_rentas = $this->sriRenta($nombreArchivo, $sris);
        $sris           = $returns_rentas['sris_coleccion'];
        $errores_excel  = $this->unificarErroresExcel($errores_excel, $returns_rentas['errores']);

        //OBJETOS SRIs DIVISAS
        $returns_divisas = $this->sriDivisas($nombreArchivo, $sris);
        $sris            = $returns_divisas['sris_coleccion'];
        $errores_excel   = $this->unificarErroresExcel($errores_excel, $returns_divisas['errores']);

        //OBJETO ESTUDIO
        $returns_estudio = $this->estudioExcel($nombreArchivo);
        $estudio         = $returns_estudio['estudio'];
        $errores_excel   = $this->unificarErroresExcel($errores_excel, $returns_estudio['errores']);

        //OBJETOS COMPANIA
        $returns_companias = $this->companiasExcel($nombreArchivo);
        $companias         = $returns_companias['companias'];
        $errores_excel     = $this->unificarErroresExcel($errores_excel, $returns_companias['errores']);

        if (count($errores_excel) > 0) {
            File::delete(storage_path('app') . '/storage/' . $nombreArchivo);
            return view('vista_previa')->with(['sumate_iniciativa' => $sumate_iniciativa, 'persona' => $persona, 'perfil' => $perfil, 'patrimonios' => $patrimonios, 'sris' => $sris, 'estudio' => $estudio, 'companias' => $companias, 'errores_excel' => $errores_excel]);
        } else {
            $sumate_iniciativa->save();
            flash('Felicidades ' . $sumate_iniciativa->nombre_aportante . ' su colaboración ha sido registrada exitosamente.')->success();
            return redirect('/sumate-a-la-iniciativa');
        }

    }

    public function unificarErroresExcel($recoleccion_errores, $errores_pestanias)
    {
        foreach ($errores_pestanias as $error) {
            array_push($recoleccion_errores, $error);
        }

        return $recoleccion_errores;
    }

    public function validarStringNumber($string_validar)
    {
        $es_numero = true;
        if (!is_null($string_validar)) {
            if (is_numeric($string_validar)) {
                $es_numero = true;
            } else {
                $es_numero = false;
            }
        } else {
            $es_numero = false;
        }

        return $es_numero;
    }

    public function personaExcel($nombre_excel)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(0); //indicamos que vamos a trabajar en la hoja 0 que es la de registro
        $objWorksheet               = $objPHPExcel->getActiveSheet(); //
        $persona                    = new Persona;
        $persona->nombres_persona   = $objWorksheet->getCell("A2")->getValue();
        $persona->apellidos_persona = $objWorksheet->getCell("B2")->getValue();

        if (str_replace(' ', '', strtolower($objWorksheet->getCell("C2")->getValue())) == 'masculino') {
            $persona->genero_persona = 1;
        } elseif (str_replace(' ', '', strtolower($objWorksheet->getCell("C2")->getValue())) == 'femenino') {
            $persona->genero_persona = 0;
        } else {
            $genero = 'error en celda C2 de la pestania Datos persona';
            array_push($errores, $genero);
        }

        $persona->fecha_nacimiento = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCell("D2")->getValue()));
        $persona->twitter_persona  = $objWorksheet->getCell("E2")->getValue();
        $persona->facebook_persona = $objWorksheet->getCell("F2")->getValue();

        return ['persona' => $persona, 'errores' => $errores];

    }

    public function perfilExcel($nombre_excel)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(1);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $perfil       = new Perfil;
        if (str_replace(' ', '', strtolower($objWorksheet->getCell("A2")->getValue())) == 'si') {
            $antecedentes_penales         = 0;
            $perfil->antecedentes_penales = $antecedentes_penales;
        } elseif (str_replace(' ', '', strtolower($objWorksheet->getCell("A2")->getValue())) == 'no') {
            $antecedentes_penales         = 1;
            $perfil->antecedentes_penales = $antecedentes_penales;
        } else {
            $perfil->antecedentes_penales = null;
            $antecedentes_penales         = 'error en celda A2 de la pestania antecedentes penales';
            array_push($errores, $antecedentes_penales);
        }

        return ['perfil' => $perfil, 'errores' => $errores];
    }

    public function patrimonioExcel($nombre_excel)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(2);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow   = $objWorksheet->getHighestRow(); //obtenemos el número total de filas
        $patrimonios  = array();
        if ($highestRow > 1) {
            for ($i = 2; $i <= $highestRow; $i++) {
                //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
                $informacion2[] = array( //en una variable recogemos los registro agrupandolos dentro de un array
                    'numFila'           => $i,
                    'fecha_declaracion' => date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('A' . $i)->getValue())),
                    'activos'           => $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getValue(),
                    'pasivos'           => $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getValue(),
                );
            }

            foreach ($informacion2 as $patrimonio_excel) {

                $patrimonio                    = new Patrimonio;
                $patrimonio->fecha_declaracion = $patrimonio_excel["fecha_declaracion"];
                $patrimonio->activos           = $patrimonio_excel["activos"];
                $patrimonio->pasivos           = $patrimonio_excel["pasivos"];

                if (is_null($patrimonio_excel["fecha_declaracion"])) {
                    $error = "Celda A" . $patrimonio_excel['numFila'] . " de la pestaña Patrimonio: No se encontro la fecha de declaración.";
                    array_push($errores, $error);
                }
                $validar_activos = $this->validarStringNumber($patrimonio_excel["activos"]);
                $validar_pasivos = $this->validarStringNumber($patrimonio_excel["pasivos"]);
                if ($validar_activos == false) {
                    $error = "Celda B" . $patrimonio_excel['numFila'] . " de la pestaña Patrimonio: No se encontro los activos.";
                    array_push($errores, $error);
                }

                if ($validar_pasivos == false) {
                    $error = "Celda C" . $patrimonio_excel['numFila'] . " de la pestaña Patrimonio: No se encontro los pasivos.";
                    array_push($errores, $error);
                }

                array_push($patrimonios, $patrimonio);
            }
        }

        return ['patrimonios' => $patrimonios, 'errores' => $errores];

    }

    public function sriRenta($nombre_excel, $sris_coleccion)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(3);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow   = $objWorksheet->getHighestRow();
        if ($highestRow > 1) {
            for ($i = 2; $i <= $highestRow; $i++) {
                //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
                $sri_renta[] = array( //en una variable recogemos los registro agrupandolos dentro de un array
                    'numFila'          => $i,
                    'anio_declaracion' => $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getValue(),
                    'monto'            => $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getValue(),
                    'tipo_impuesto'    => 2,

                );
            }

            foreach ($sri_renta as $sri_excel) {
                $sri                     = new Sri;
                $sri->anio_sri           = $sri_excel['anio_declaracion'];
                $sri->valor_impuesto_sri = $sri_excel['monto'];
                $sri->tipo_impuesto_sri  = $sri_excel['tipo_impuesto'];

                $validar_anio          = $this->validarStringNumber($sri_excel["anio_declaracion"]);
                $validar_monto         = $this->validarStringNumber($sri_excel["monto"]);
                $validar_tipo_impuesto = $this->validarStringNumber($sri_excel["tipo_impuesto"]);

                if ($validar_anio == false) {
                    $error = "Celda A" . $sri_excel['numFila'] . " de la pestaña Impuesto Renta: No se encontro el año de declaración.";
                    array_push($errores, $error);
                }
                if ($validar_monto == false) {
                    $error = "Celda B" . $sri_excel['numFila'] . " de la pestaña Impuesto Renta: No se encontro el monto de declaración.";
                    array_push($errores, $error);
                }
                array_push($sris_coleccion, $sri);
            }
        }
        return ['sris_coleccion' => $sris_coleccion, 'errores' => $errores];
    }

    public function sriDivisas($nombre_excel, $sris_coleccion)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(4);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow   = $objWorksheet->getHighestRow();
        if ($highestRow > 1) {
            for ($i = 2; $i <= $highestRow; $i++) {
                //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
                $sri_divisas[] = array( //en una variable recogemos los registro agrupandolos dentro de un array
                    'numFila'          => $i,
                    'anio_declaracion' => $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getValue(),
                    'monto'            => $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getValue(),
                    'tipo_impuesto'    => 1,

                );
            }

            foreach ($sri_divisas as $sri_divisas_excel) {
                $sri                     = new Sri;
                $sri->anio_sri           = $sri_divisas_excel['anio_declaracion'];
                $sri->valor_impuesto_sri = $sri_divisas_excel['monto'];
                $sri->tipo_impuesto_sri  = $sri_divisas_excel['tipo_impuesto'];

                $validar_anio          = $this->validarStringNumber($sri_divisas_excel["anio_declaracion"]);
                $validar_monto         = $this->validarStringNumber($sri_divisas_excel["monto"]);
                $validar_tipo_impuesto = $this->validarStringNumber($sri_divisas_excel["tipo_impuesto"]);

                if ($validar_anio == false) {
                    $error = "Celda A" . $sri_divisas_excel['numFila'] . " de la pestaña Impuesto divisas: No se encontro el año de declaración.";
                    array_push($errores, $error);
                }
                if ($validar_monto == false) {
                    $error = "Celda B" . $sri_divisas_excel['numFila'] . " de la pestaña Impuesto divisas: No se encontro el monto de declaración.";
                    array_push($errores, $error);
                }
                array_push($sris_coleccion, $sri);
            }
        }
        return ['sris_coleccion' => $sris_coleccion, 'errores' => $errores];

    }

    public function estudioExcel($nombre_excel)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(5);
        $objWorksheet               = $objPHPExcel->getActiveSheet();
        $estudio                    = new Estudio;
        $estudio->profesion_estudio = $objWorksheet->getCell("A2")->getValue();
        $estudio->pregrado_estudio  = $objWorksheet->getCell("B2")->getValue();
        $estudio->posgrado_estudio  = $objWorksheet->getCell("C2")->getValue();
        $estudio->phd_estudio       = $objWorksheet->getCell("D2")->getValue();
        $estudio->estudio_area_id   = 1;

        if (!is_null($estudio->pregrado_estudio) && !is_numeric($estudio->pregrado_estudio)) {
            $error = "Celda B2 de la pestaña Estudios: No se encontro el número de titulos de pregrado.";
            array_push($errores, $error);
        }
        if (!is_null($estudio->posgrado_estudio) && !is_numeric($estudio->posgrado_estudio)) {
            $error = "Celda C2 de la pestaña Estudios: No se encontro el número de titulos de posgrado.";
            array_push($errores, $error);
        }
        if (!is_null($estudio->phd_estudio) && !is_numeric($estudio->phd_estudio)) {
            $error = "Celda D2 de la pestaña Estudios: No se encontro el número de titulos de PhD.";
            array_push($errores, $error);
        }

        return ['estudio' => $estudio, 'errores' => $errores];
    }

    public function companiasExcel($nombre_excel)
    {
        $errores     = array();
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app') . '/storage/' . $nombre_excel);
        $objPHPExcel->setActiveSheetIndex(6);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow   = $objWorksheet->getHighestRow();
        $companias    = array();
        if ($highestRow > 1) {
            for ($i = 2; $i <= $highestRow; $i++) {
                //recorremos todas los registros, empiezan desde la fila 7 hasta el número total de filas
                $companias_excel[] = array( //en una variable recogemos los registro agrupandolos dentro de un array
                    'numFila'           => $i,
                    'nombre_compania'   => $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getValue(),
                    'posicion_compania' => $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getValue(),

                );
            }

            $array_posiciones = array("presidente", "gerente", "accionista");
            foreach ($companias_excel as $compania_excel) {

                $id_posicion = array_search(str_replace(' ', '', strtolower($compania_excel['posicion_compania'])), $array_posiciones);
                $compania    = new Compania;

                $compania->nombre_compania = $compania_excel['nombre_compania'];

                if ($id_posicion >= 0) {
                    $compania->posicion_compania = $id_posicion + 1;
                } else {
                    $compania->posicion_compania = null;
                    $error                       = "Celda B" . $compania_excel['numFila'] . " de la pestaña Compania: Asegúrese de ingresar correctamente la posición.";
                    array_push($errores, $error);
                }

                array_push($companias, $compania);
            }
        }

        return ['companias' => $companias, 'errores' => $errores];

    }
}
