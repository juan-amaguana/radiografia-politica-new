<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\FuncionEstado;
use App\Models\Posicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosicionController extends Controller
{
    protected $rules = [
        'nombre_posicion'            => 'required|max:120',
        'categoria_posicion_funcion' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posiciones = Posicion::paginate();
        //dd($posiciones);
        return view('admin.posicion.index')->with(['posiciones' => $posiciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias                   = Categoria::all();
        $funciones_estado             = FuncionEstado::funcionesEstado();
        $instituciones_independientes = FuncionEstado::institucionesIndependientes();
        return view('admin.posicion.create')->with(['categorias' => $categorias, 'funciones_estado' => $funciones_estado, 'instituciones_independientes' => $instituciones_independientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $posicion                  = new Posicion;
        $posicion->nombre_posicion = $request->nombre_posicion;

        if ($request->categoria_posicion_funcion != 3) {
            if ($request->categoria_posicion_funcion == 1) {
                $posicion->categoria_id      = $request->categoria_id;
                $posicion->funcion_estado_id = $request->funcion_estado_id;
            } else {
                $posicion->funcion_estado_id = $request->institucion_independiente_id;
            }
        }

        $posicion->user_id = Auth::user()->id;
        $posicion->save();

        //$this->storeCateoriasPosicion($request,$posicion);

        flash('La posicion ' . $posicion->nombre_posicion . ' ha sido registrado.')->success();

        return redirect('/admin/posiciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posicion  $posicion
     * @return \Illuminate\Http\Response
     */
    public function show(Posicion $posicion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posicion  $posicion
     * @return \Illuminate\Http\Response
     */
    public function edit($posicion_id)
    {
        $posicion                     = Posicion::find($posicion_id);
        $categorias                   = Categoria::all();
        $funciones_estado             = FuncionEstado::funcionesEstado();
        $instituciones_independientes = FuncionEstado::institucionesIndependientes();
        return view('admin.posicion.edit')->with(['categorias' => $categorias, 'posicion' => $posicion, 'funciones_estado' => $funciones_estado, 'instituciones_independientes' => $instituciones_independientes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posicion  $posicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $posicion_id)
    {
        $this->validate($request, $this->rules);

        $posicion                  = Posicion::find($posicion_id);
        $posicion->nombre_posicion = $request->nombre_posicion;
        if ($request->categoria_posicion_funcion != 3) {
            if ($request->categoria_posicion_funcion == 1) {
                $posicion->categoria_id      = $request->categoria_id;
                $posicion->funcion_estado_id = $request->funcion_estado_id;
            } else {
                $posicion->categoria_id      = null;
                $posicion->funcion_estado_id = $request->institucion_independiente_id;
            }
        }

        $posicion->save();

        //$this->updateCateoriasPosicion($request,$posicion);
        flash('La posicion <strong>' . $posicion->nombre_posicion . '</strong> ha sido actualizada')->info();
        return redirect('/admin/posiciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posicion  $posicion
     * @return \Illuminate\Http\Response
     */
    public function destroy($posicion_id)
    {
        $posicion = Posicion::find($posicion_id);
        $posicion->delete();

        flash('La posicion <strong>' . $posicion->nombre_posicion . '</strong> ha sido eliminada')->error();
        return redirect('/admin/posiciones');
    }

    public function obtenerPersonasCargo()
    {
        return Posicion::obtenerPersonasCargo();
    }
}