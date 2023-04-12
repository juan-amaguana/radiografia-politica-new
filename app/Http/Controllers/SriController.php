<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Sri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SriController extends Controller
{
    protected $rules = [
        'tipo_impuesto_sri' => 'required|numeric',
        'anio_sri'          => 'required|numeric',
        'perfil_id'         => 'required|numeric',

    ];

    protected $rules_declaracion = [
        'valor_impuesto_sri' => 'required|numeric',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sris = [];
        if (isset($request->tipo_impuesto_sri) && $request->tipo_impuesto_sri !== "") {
            $sris = Sri::where('tipo_impuesto_sri', $request->tipo_impuesto_sri)->get();
        } else {
            $sris = Sri::all();
        }
        
        return view('admin.sri.index')->with(['sris' => $sris]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $perfiles = Perfil::all();
        return view('admin.sri.create')->with(['perfiles' => $perfiles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('hola');
        $this->validate($request, $this->rules);

        if ($request->declaracion == 2) {
            $this->validate($request, $this->rules_declaracion);
            $sri            = $request->all();
            $sri['user_id'] = Auth::user()->id;

            Sri::create($sri);
        } else {

            $sri                       = $request->all();
            $sri['user_id']            = Auth::user()->id;
            $sri['valor_impuesto_sri'] = null;
            Sri::create($sri);
        }
        $perfil = Perfil::find($sri['perfil_id']);
        flash('El impuesto SRI de la persona ' . $perfil->persona->nombres_persona . ' ' . $perfil->persona->apellidos_persona . ' ha sido registrado.')->success();

        return redirect('/admin/sri');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sri  $sri
     * @return \Illuminate\Http\Response
     */
    public function show(Sri $sri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sri  $sri
     * @return \Illuminate\Http\Response
     */
    public function edit(Sri $sri)
    {
        $perfiles = Perfil::all();
        return view('admin.sri.edit')->with(['sri' => $sri, 'perfiles' => $perfiles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sri  $sri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sri $sri)
    {
        $this->validate($request, $this->rules);
        $sri->perfil_id          = $request->perfil_id;
        $sri->tipo_impuesto_sri  = $request->tipo_impuesto_sri;
        $sri->anio_sri           = $request->anio_sri;
        $sri->valor_impuesto_sri = $request->valor_impuesto_sri;
        $sri->save();

        if ($request->declaracion == 2) {
            $sri->perfil_id          = $request->perfil_id;
            $sri->tipo_impuesto_sri  = $request->tipo_impuesto_sri;
            $sri->declaracion        = $request->declaracion;
            $sri->anio_sri           = $request->anio_sri;
            $sri->valor_impuesto_sri = $request->valor_impuesto_sri;
            $sri->save();
        } else {

            $sri->perfil_id          = $request->perfil_id;
            $sri->tipo_impuesto_sri  = $request->tipo_impuesto_sri;
            $sri->declaracion        = $request->declaracion;
            $sri->anio_sri           = $request->anio_sri;
            $sri->valor_impuesto_sri = null;
            $sri->save();
        }

        flash('El impuesto SRI de la persona ' . $sri->perfil->persona->nombres_persona . ' ' . $sri->perfil->persona->apellidos_persona . ' ha sido actualizada.')->info();
        return redirect('/admin/sri');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sri  $sri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $sri_request)
    {

        $sri = Sri::find($sri_request->impuesto_id);
        $sri->delete();

        if (isset($sri->perfil->persona->nombres_persona)) {
            flash('El impuesto SRI de la persona ' . $sri->perfil->persona->nombres_persona . ' ' . $sri->perfil->persona->apellidos_persona . ' del año ' . $sri->anio_sri . ' ha sido eliminada.')->error();
        } else {
            flash('El impuesto ' . $sri->tipo_impuesto_sri . ' ha sido eliminada.')->error();
        }

        return redirect('/admin/sri');
    }

    public function sriGrafica($anio)
    {

        $sris_renta = Sri::sriGraficaRenta($anio);

        $sris_grafica = [];

        //array_push($sris_grafica, $item_arrya);
        //dd($sris_grafica);
        foreach ($sris_renta as $sri_renta) {

            $persona_sri_divisa = $this->obtenerItemSriDivisas($sri_renta->persona_id, $anio);

            $persona_sri = $this->obtenerNombreSriPersona($sri_renta);

            $item_sri_grafica = ['nombres_completos' => $sri_renta->nombres_persona . " " . $sri_renta->apellidos_persona, 'nombre' => $persona_sri, 'persona_id' => $sri_renta->persona_id, 'sri_rentas' => $sri_renta->sri_rentas, 'sri_divisa' => $persona_sri_divisa->sri_divisas];

            array_push($sris_grafica, $item_sri_grafica);

        }

        return $sris_grafica;
    }

    public function obtenerItemSriDivisas($index_array_search, $anio)
    {
        $sris_divisas       = Sri::sriGrficaDivisas($anio);
        $key_divisa         = array_search($index_array_search, array_column($sris_divisas, 'persona_id'));
        $persona_sri_divisa = $sris_divisas[$key_divisa];

        return $persona_sri_divisa;
    }

    public function obtenerNombreSriPersona($sri_renta)
    {
        $nombres_array   = explode(" ", $sri_renta->nombres_persona);
        $apellidos_array = explode(" ", $sri_renta->apellidos_persona);

        return $nombres_array[0] . " " . $apellidos_array[0];
    }

    public function obtenerSriFuncionEstado($function_estado, $anio)
    {
        $impuestos_renta = Sri::obtenerSriFuncionEstado($function_estado, $anio);

        return $impuestos_renta;
    }

    public function obtenerSriFuncionEstadoTodos($anio)
    {
        $impuestos_todos = Sri::obtenerSriFuncionEstadoTodos($anio);
        return $impuestos_todos;
    }

    public function obtenerSriRangoFuncionEstado($function_estado, $rango)
    {
        //dd('hola');
        $data_sri        = Sri::obtenerSriRango($function_estado, $rango);
        $datos_ordenados = array();
        foreach ($data_sri as $sri) {
            $sri->valor_impuesto_sri = number_format($sri->valor_impuesto_sri, 2, ',', '.');
            array_push($datos_ordenados, $sri);
        }
        return $datos_ordenados;
    }

    public function obtenerSriRangoTodosFuncionEstado($rango)
    {
        $data_sri        = Sri::obtenerSriTodosRango($rango);
        $datos_ordenados = array();
        foreach ($data_sri as $sri) {
            $sri->valor_impuesto_sri = number_format($sri->valor_impuesto_sri, 2, ',', '.');
            array_push($datos_ordenados, $sri);
        }
        return $datos_ordenados;
    }

    public function obtenerPorcentajeSriRangoFuncionEstado($function_estado)
    {
        $rangos_consulta = array('0', "1-500", "501-2000", '2001-5000', '5001');
        $data_grafica    = array();

        for ($i = 0; $i < count($rangos_consulta); $i++) {

            $rango_sri = Sri::obtenerPorcentajeSriRango($function_estado, $rangos_consulta[$i]);

            $data = array();
            if ($rangos_consulta[$i] == '5001') {
                $data += ["rango_sri" => 'Declaraciones mayores a $' . $rangos_consulta[$i]];
            } else {
                $data += ["rango_sri" => 'Declaraciones de $' . str_replace("-", " a $", $rangos_consulta[$i])];
            }
            $data += ["rango_declaracion" => $rangos_consulta[$i]];
            $data += ["total_personas" => $rango_sri->total_persona];

            array_push($data_grafica, $data);

        }

        return $data_grafica;

    }

    public function obtenerSriRangoTodos()
    {
        $rangos_consulta = array('0', "1-500", "501-2000", '2001-5000', '5001');
        $data_grafica    = array();

        for ($i = 0; $i < count($rangos_consulta); $i++) {

            $rango_sri = Sri::obtenerPorcentajeSriRangoTodos($rangos_consulta[$i]);

            $data = array();
            if ($rangos_consulta[$i] == '5001') {
                $data += ["rango_sri" => 'Declaraciones mayores a $' . $rangos_consulta[$i]];
            } else {
                $data += ["rango_sri" => 'Declaraciones de $' . str_replace("-", " a $", $rangos_consulta[$i])];
            }
            if (!is_null($rango_sri->total_sri)) {
                $data += ["total_declaracion" => $rango_sri->total_sri];
            } else {
                $data += ["total_declaracion" => 0];
            }
            $data += ["rango_declaracion" => $rangos_consulta[$i]];
            $data += ["total_personas" => $rango_sri->total_persona];

            array_push($data_grafica, $data);

        }

        return $data_grafica;
    }

}