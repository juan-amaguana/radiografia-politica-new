<?php

namespace App\Http\Controllers;

use App\Models\Penal;
use App\Models\perfil;
use App\Models\TipoJuicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenalController extends Controller
{
	protected $rules = [
        'nombre_penal' => 'required|max:60',
        'total_penal' => 'required|numeric',
        'tipo_jucio_id' => 'required|numeric',
        'perfil_id' => 'required|numeric',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penales = Penal::all();
        return view('admin.penal.index')->with(['penales'=>$penales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = Perfil::all();
    	$tipo_juciales = TipoJuicio::all();
        return view('admin.penal.create')->with(['perfiles'=>$perfiles,'tipo_juciales'=>$tipo_juciales]);
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

        $penal = $request->all();
        $penal['user_id'] = Auth::user()->id;

        Penal::create($penal);

        flash('Penal '.$penal['nombre_penal'].' ha sido registrado.')->success();

        return redirect('/admin/penales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penal  $penal
     * @return \Illuminate\Http\Response
     */
    public function show(Penal $penal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penal  $penal
     * @return \Illuminate\Http\Response
     */
    public function edit($penal_id)
    {
    	$penal = Penal::find($penal_id);
        $perfiles = Perfil::all();
    	$tipo_juciales = TipoJuicio::all();

        return view('admin.penal.edit')->with(['perfiles'=>$perfiles,'tipo_juciales'=>$tipo_juciales,'penal'=>$penal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penal  $penal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penal_id)
    {
        $this->validate($request, $this->rules);
        $penal = Penal::find($penal_id);
        $penal->perfil_id = $request->perfil_id ;
        $penal->tipo_jucio_id = $request->tipo_jucio_id ;
        $penal->nombre_penal = $request->nombre_penal ;
        $penal->total_penal = $request->total_penal ;
        $penal->save();

        flash('Penal'.$penal->nombre_penal.' ha sido actualizado.')->info();

        return redirect('/admin/penales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penal  $penal
     * @return \Illuminate\Http\Response
     */
    public function destroy($penal_id)
    {
    	$penal = Penal::find($penal_id);
        $penal->delete();

        flash('Penal'.$penal->nombre_penal.' ha sido eliminado.')->error();

        return redirect('/admin/penales');
    }
}
