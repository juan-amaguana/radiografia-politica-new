<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CompaniaController extends Controller
{
    protected $rules = [
        'nombre_compania' => 'required|max:60',
        'posicion_compania' => 'required|numeric',
        'perfil_id' => 'required|numeric',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companias = Compania::all(); 
        return view('admin.compania.index')->with(['companias'=>$companias]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = Perfil::all();
        return view('admin.compania.create')->with(['perfiles'=>$perfiles]);
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

        $compania = $request->all();
        $compania['user_id'] = Auth::user()->id;
        Compania::create($compania);

        flash('La compania '.$compania['nombre_compania'].' ha sido registrado.')->success();

        return redirect('/admin/companias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function show(Compania $compania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function edit(Compania $compania)
    {
        $perfiles = Perfil::all();
        return view('admin.compania.edit')->with(['compania'=>$compania,'perfiles'=>$perfiles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compania $compania)
    {
        $this->validate($request, $this->rules);
        $compania->perfil_id = $request->perfil_id ;
        $compania->nombre_compania = $request->nombre_compania ;
        $compania->posicion_compania = $request->posicion_compania ;
        $compania->estado = $request->estado;
        $compania->posicion = $request->posicion;
        //$compania->total_compania = $request->total_compania ;
        $compania->save();

        flash('La compania '.$compania->nombre_compania.' ha sido actualizada.')->info();
        return redirect('/admin/companias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compania  $compania
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compania $compania)
    {
        $compania->delete();

        flash('La compania '.$compania->nombre_compania.' ha sido eliminada.')->error();
        return redirect('/admin/companias');

    }
}