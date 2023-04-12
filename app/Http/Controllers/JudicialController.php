<?php

namespace App\Http\Controllers;

use App\Models\Judicial;
use App\Models\perfil;
use App\Models\TipoJuicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudicialController extends Controller
{
	protected $rules = [
        'nombre_judicial' => 'required|max:60',
        'numero_judicial' => 'required|numeric',
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
        $judiciales = Judicial::all();
        return view('admin.judicial.index')->with(['judiciales'=>$judiciales]);
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
        return view('admin.judicial.create')->with(['perfiles'=>$perfiles,'tipo_juciales'=>$tipo_juciales]);
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

        $judicial = $request->all();
        $judicial['user_id'] = Auth::user()->id;

        Judicial::create($judicial);

        flash('Judical '.$judicial['nombre_judicial'].' ha sido registrado.')->success();

        return redirect('/admin/judiciales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Judicial  $judicial
     * @return \Illuminate\Http\Response
     */
    public function show(Judicial $judicial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Judicial  $judicial
     * @return \Illuminate\Http\Response
     */
    public function edit($judicial_id)
    {
        $judicial = Judicial::find($judicial_id);
        $perfiles = Perfil::all();
    	$tipo_juciales = TipoJuicio::all();

        return view('admin.judicial.edit')->with(['perfiles'=>$perfiles,'tipo_juciales'=>$tipo_juciales,'judicial'=>$judicial]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Judicial  $judicial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $judicial_id)
    {
    	$this->validate($request, $this->rules);
        $judicial = Judicial::find($judicial_id);
        $judicial->perfil_id = $request->perfil_id ;
        $judicial->tipo_jucio_id = $request->tipo_jucio_id ;
        $judicial->nombre_judicial = $request->nombre_judicial ;
        $judicial->numero_judicial = $request->numero_judicial ;
        $judicial->save();

        flash('Judicial'.$judicial->nombre_judicial.' ha sido actualizado.')->info();

        return redirect('/admin/judiciales');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Judicial  $judicial
     * @return \Illuminate\Http\Response
     */
    public function destroy($judicial_id)
    {
        $judicial = Judicial::find($judicial_id);
        $judicial->delete();

        flash('Judicial'.$judicial->nombre_judicial.' ha sido eliminado.')->error();

        return redirect('/admin/judiciales');
    }
}
