<?php

namespace App\Http\Controllers;

use App\Models\Patrimonio;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class PatrimonioController extends Controller
{
    protected $rules = [
        'fecha_declaracion' => 'required',

        'activos' => 'required|numeric',
        'pasivos' => 'required|numeric',
        'perfil_id' => 'required',
        'nombre_archivo_patrimonio1' => 'required|mimes:pdf,doc,docx',
        'nombre_archivo_patrimonio2' => 'mimes:pdf,doc,docx',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrimonios = Patrimonio::all();
        return view('admin.patrimonio.index')->with(['patrimonios' => $patrimonios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = Perfil::all();
        return view('admin.patrimonio.create')->with(['perfiles' => $perfiles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $this->validate($request, $this->rules);
        $perfil = Perfil::find($request->perfil_id);

        $patrimonio = $request->all();
        $patrimonio['fecha_declaracion'] = $request->fecha_declaracion;
        $patrimonio['user_id'] = Auth::user()->id;
        $patrimonio['patrimonio'] = $patrimonio['activos'] - $patrimonio['pasivos'];

        $nombre_archivo_patrimonio1 = $this->storeArchivo($perfil->persona, $request->nombre_archivo_patrimonio1, 'archivo1');
        $patrimonio['nombre_archivo_patrimonio1'] = $nombre_archivo_patrimonio1;

        if ($request->hasFile('nombre_archivo_patrimonio2')) {
            $nombre_archivo_patrimonio2 = $this->storeArchivo($perfil->persona, $request->nombre_archivo_patrimonio2, 'archivo2');
            $patrimonio['nombre_archivo_patrimonio2'] = $nombre_archivo_patrimonio2;
        }
        if (is_null($request->fecha_declaracion_anterior)) {
            $patrimonio['fecha_declaracion_anterior'] = null;
        } else {
            $patrimonio['fecha_declaracion_anterior'] = $request->fecha_declaracion_anterior;
        }
        Patrimonio::create($patrimonio);

        flash('El patrimonio del usuario ' . $perfil->persona->nombres_persona . ' ' . $perfil->persona->apellidos_persona . ' ha sido registrado.')->success();

        return redirect('/admin/patrimonios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patrimonio $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function show(Patrimonio $patrimonio)
    {

        return view('admin.patrimonio.show')->with(['patrimonio' => $patrimonio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patrimonio $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function edit(Patrimonio $patrimonio)
    {
        //dd($patrimonio);
        $perfiles = Perfil::all();
        return view('admin.patrimonio.edit')->with(['perfiles' => $perfiles, 'patrimonio' => $patrimonio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Patrimonio $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patrimonio $patrimonio)
    {
        $this->validate(request(), [
            'fecha_declaracion' => 'required',
            'activos' => 'required|numeric',
            'pasivos' => 'required|numeric',
            'perfil_id' => 'required',
        ]);

        $perfil = Perfil::find($request->perfil_id);
        $patrimonio->perfil_id = $request->perfil_id;
        //$patrimonio->dinero = $request->dinero ;
        $patrimonio->numero_casas = $request->numero_casas ;
        $patrimonio->numero_carros = $request->numero_carros ;
        //$patrimonio->numero_companias = $request->numero_companias ;
        $patrimonio->fecha_declaracion = $request->fecha_declaracion;
        //dd($patrimonio->fecha_declaracion);
        if (is_null($request->fecha_declaracion_anterior)) {
            $patrimonio->fecha_declaracion_anterior = null;
        } else {
            $patrimonio->fecha_declaracion_anterior = $request->fecha_declaracion_anterior;
        }

        $patrimonio->activos = $request->activos;
        $patrimonio->pasivos = $request->pasivos;
        $patrimonio->publicar = $request->publicar;
        $patrimonio->patrimonio = $request->activos - $request->pasivos;
        if ($request->hasFile('nombre_archivo_patrimonio1')) {
            //dd('entre');
            $this->destroyArchivo($patrimonio->nombre_archivo_patrimonio1);
            $nombre_archivo_patrimonio1 = $this->storeArchivo($perfil->persona, $request->nombre_archivo_patrimonio1, 'archivo1');
            $patrimonio->nombre_archivo_patrimonio1 = $nombre_archivo_patrimonio1;
        }

        if ($request->hasFile('nombre_archivo_patrimonio2')) {
            $this->destroyArchivo($patrimonio->nombre_archivo_patrimonio2);
            $nombre_archivo_patrimonio2 = $this->storeArchivo($perfil->persona, $request->nombre_archivo_patrimonio2, 'archivo2');
            $patrimonio->nombre_archivo_patrimonio2 = $nombre_archivo_patrimonio2;
        }
        $patrimonio->save();
        flash('El patrimonio del usuario ' . $patrimonio->perfil->persona->nombres_persona . ' ' . $patrimonio->perfil->persona->apellidos_persona . ' ha sido actualizado.')->info();
        return redirect('/admin/patrimonios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patrimonio $patrimonio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patrimonio $patrimonio)
    {
        $patrimonio->delete();
        $this->destroyArchivo($patrimonio->nombre_archivo_patrimonio1, 'archivosPatrimonios1');
        $this->destroyArchivo($patrimonio->nombre_archivo_patrimonio2, 'archivosPatrimonios2');
        flash('El patrimonio del usuario ' . $patrimonio->perfil->persona->nombres_persona . ' ' . $patrimonio->perfil->persona->apellidos_persona . ' ha sido eliminado.')->error();
        return redirect('/admin/patrimonios');

    }

    public function storeArchivo($persona, $archivo_request, $tipo_archivo)
    {

        $nombreArchivo = strtotime("now") . '_' . str_replace(" ", "_", $persona->nombres_persona . $persona->apellidos_persona) . $tipo_archivo . '.' . $archivo_request->getClientOriginalExtension();

        Storage::disk('archivosPatrimonio')->put($nombreArchivo, file_get_contents($archivo_request->getRealPath()));

        $nombre_patrimonio_archivo = '/docs/patrimonio/' . $nombreArchivo;

        return $nombre_patrimonio_archivo;
    }

    public function destroyArchivo($nombre_archivo)
    {
        $ruta_archivo = explode("/", $nombre_archivo);
        $nombre_patrimonio = end($ruta_archivo);
        //dd($nombre_patrimonio);
        Storage::disk('archivosPatrimonio')->delete($nombre_patrimonio);
    }

    public function patrimonioGrafica($anio)
    {
        return Patrimonio::obtenerPatrimonioAnio($anio);
    }

    public function obtenerPatrimoniosFuncionEstado($function_estado)
    {
        $datos_ordenados = array();
        $valores_patrimonio = Patrimonio::patrimonioFuncionEstado($function_estado);
        foreach ($valores_patrimonio as $patrimonio) {
            array_unshift($datos_ordenados, $patrimonio);
        }
        return $datos_ordenados;
    }

    public function obtenerPatrimoniosFuncionEstadoTodos()
    {
        $datos_patrimonios_todos = Patrimonio::patrimonioFuncionEstadoTodos();

        $datos_ordenados = array();

        foreach ($datos_patrimonios_todos as $patrimonio) {
            array_unshift($datos_ordenados, $patrimonio);
        }
        return $datos_ordenados;

    }

    public function obtenerPatrimoniosRangoFuncionEstado($function_estado, $rango)
    {
        $datos_ordenados = array();
        $valores_patrimonio = Patrimonio::patrimonioPersonasRangoFuncionEstado($function_estado, $rango);

        foreach ($valores_patrimonio as $patrimonio) {
            $patrimonio->patrimonio = number_format($patrimonio->patrimonio, 2, ',', '.');
            array_unshift($datos_ordenados, $patrimonio);
        }
        return $datos_ordenados;
    }

    public function obtenerPatrimoniosTodosRangoFuncionEstado($rango)
    {
        $datos_ordenados = array();
        $valores_patrimonio = Patrimonio::patrimonioRangoTodosFuncionEstado($rango);
        foreach ($valores_patrimonio as $patrimonio) {
            $patrimonio->patrimonio = number_format($patrimonio->patrimonio, 2, ',', '.');
            array_unshift($datos_ordenados, $patrimonio);
        }
        return $datos_ordenados;
    }

    public function rangoPatrimonio($function_estado)
    {
        $rangos_consulta = array([-999999, -1], '0', "1-50000", "50001-100000", '100001-500000', '500001-1000000', '1000001');
        $data_grafica = array();

        //dd($data_grafica);

        foreach ($rangos_consulta as $rango) {

            $rango_patrimonio = Patrimonio::patrimonioRangoFuncionEstado($function_estado, $rango);

            $data = array();
            if ($rango == '1000001') {
                $data += ["rango_patrimonio" => 'Declaraciones mayores a $' . number_format($rango, 2, ',', '.')];
            } else {
                $rangos = (is_array($rango)) ? $rango : explode("-", $rango);

                if (count($rangos) > 1) {
                    if ($rangos[0] < 0 && $rangos[1] < 0) {
                        $data += ["rango_patrimonio" => "Declaraciones de valores en negativo"];
                    } else {
                        //dd($rangos,number_format($rangos[0], 2, ',', '.'));
                        $valor_inicial = number_format($rangos[0], 2, ',', '.');
                        $valor_final = number_format($rangos[1], 2, ',', '.');
                        $data += ["rango_patrimonio" => 'Declaraciones de $' . $valor_inicial . ' a $' . $valor_final];
                    }

                } else {
                    $data += ["rango_patrimonio" => 'Declaraciones de $' . number_format($rango, 2, ',', '.')];
                }
            }
            $data += ["rango_declaracion" => $rango];
            $data += ["total_personas" => $rango_patrimonio->total_persona];

            array_push($data_grafica, $data);

        }

        return $data_grafica;
    }

    public function rangoPatrimoniosTodos()
    {
        $rangos_consulta = array(['-999999', '-1'], '0', "1-50000", "50001-100000", '100001-500000', '500001-1000000', '1000001');
        $data_grafica = array();

        foreach ($rangos_consulta as $rango) {

            $rango_patrimonio = Patrimonio::rangoPatrimoniosTodos($rango);

            $data = array();
            if ($rango == '1000001') {
                $data += ["rango_patrimonio" => 'Declaraciones mayores a $' . number_format($rango, 2, ',', '.')];
            } else {
                $rangos = (is_array($rango)) ? $rango : explode("-", $rango);
                if (count($rangos) > 1) {
                    if ($rangos[0] < 0 && $rangos[1] < 0) {
                        $data += ["rango_patrimonio" => "Declaraciones de valores en negativo"];
                    } else {
                        $valor_inicial = number_format($rangos[0], 2, ',', '.');
                        $valor_final = number_format($rangos[1], 2, ',', '.');
                        $data += ["rango_patrimonio" => 'Declaraciones de $' . $valor_inicial . ' a $' . $valor_final];
                    }
                } else {
                    $data += ["rango_patrimonio" => 'Declaraciones de $' . number_format($rango, 2, ',', '.')];
                }
            }

            if (!is_null($rango_patrimonio->total_patrimonio)) {
                $data += ["total_declaracion" => $rango_patrimonio->total_patrimonio];
            } else {
                $data += ["total_declaracion" => 0];
            }

            $data += ["rango_declaracion" => $rango];
            $data += ["total_personas" => $rango_patrimonio->total_persona];

            array_push($data_grafica, $data);

        }

        return $data_grafica;
    }
}