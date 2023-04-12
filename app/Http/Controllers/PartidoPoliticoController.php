<?php

namespace App\Http\Controllers;

use App\Models\PartidoPolitico;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Image;
use File;

class PartidoPoliticoController extends Controller
{
    protected $rules = [
        'nombre_partido_politico' => 'required|max:60',
        'imagen_partido_politico' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partidos_politicos = PartidoPolitico::all();
        return view('admin.partido_politico.index')->with(['partidos_politicos'=>$partidos_politicos]);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.partido_politico.create')->with(['users'=>$users]);
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

        $nombre_imagen_partido_politico = $this->storeImagePartidoPolitico($request);
        $partido_politico = $request->all();
        $partido_politico['user_id'] = Auth::user()->id;
        $partido_politico['imagen_partido_politico'] = $nombre_imagen_partido_politico;
        //dd($partido_politico);
        PartidoPolitico::create($partido_politico);

        flash('El partido politico '.$partido_politico['nombre_partido_politico'].' ha sido registrado.')->success();

        return redirect('/admin/partidosPoliticos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function show(PartidoPolitico $partidoPolitico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function edit($partido_politico_id)
    {
        $partido_politico = PartidoPolitico::find($partido_politico_id);
        $users = User::all();

        return view('admin.partido_politico.edit')->with(['partido_politico'=>$partido_politico, 'users'=>$users]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $partido_politico_id)
    {
        $this->validate(request(), [
        'nombre_partido_politico' => 'required|max:60',
        
        ]);

        $partido_politico = PartidoPolitico::find($partido_politico_id);
        if ($request->hasFile('imagen_partido_politico')) {
            $nombre_imagen_partido = $this->updateImagenPolitico($partido_politico,$request);
            $partido_politico->imagen_partido_politico = $nombre_imagen_partido;
        }
        $partido_politico->nombre_partido_politico=$request->nombre_partido_politico;
        $partido_politico->save();

        flash('El partido politico '.$partido_politico->nombre_partido_politico.' ha sido actualizado.')->info();

        return redirect('/admin/partidosPoliticos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function destroy($partido_politico_id)
    {
        $partido_politico = PartidoPolitico::find($partido_politico_id);
        $this->deleteImagenPolitico($partido_politico);
        $partido_politico->delete();
        flash('El partido politico '.$partido_politico->nombre_partido_politico.' ha sido eliminado.')->error();

        return redirect('/admin/partidosPoliticos');
    }

    public function storeImagePartidoPolitico($datos_partido_politico){
        
        $imagen_partido_politico = $datos_partido_politico->file('imagen_partido_politico');
        $nombre_imagen = time().'-'.str_replace(" ", "_", $datos_partido_politico->nombre_partido_politico).'.'.$imagen_partido_politico->getClientOriginalExtension();
        
        Image::make($imagen_partido_politico)->resize(200, 200)->save(public_path('/img/political-parties/'.$nombre_imagen));

        $nombre_imagen_politico = '/img/political-parties/'.$nombre_imagen;
       
        return $nombre_imagen_politico;

    }

    public function updateImagenPolitico($datos_partido_politico,$datos_partido_politico_update){
      $this->deleteImagenPolitico($datos_partido_politico);
      $nombre_imagen_politico = $this->storeImagePartidoPolitico($datos_partido_politico_update);
      return $nombre_imagen_politico;
    }

    public function deleteImagenPolitico($datos_partido_politico){
        //dd($datos_partido_politico);
      File::delete(public_path($datos_partido_politico->imagen_partido_politico));
    }
}
