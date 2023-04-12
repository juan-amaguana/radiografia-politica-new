<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Image;
use File;

class PerfilController extends Controller
{
    protected $rules = [
        'antecedentes_penales' => 'numeric|required',
        'persona_id' => 'required|numeric',

    ]; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = Perfil::all();
        return view('admin.perfil.index')->with(['perfiles'=>$perfiles]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = Persona::all();
        return view('admin.perfil.create')->with(['personas'=>$personas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request); 
        $persona = Persona::find($request->persona_id); 

        $this->validate($request, $this->rules);

        $perfil = $request->all();
        $perfil['user_id'] = Auth::user()->id;
        if ($request->hasFile('picture')) {
            $picture = $this->storeImagePolitico($request);
            $perfil['picture'] = $picture;
        }

        if ($request->hasFile('nombre_archivo_sri')) { 
            $nombre_documento_sri = $this->storeArchivo($persona, $request->nombre_archivo_sri, '-sri');
            $perfil['nombre_archivo_sri'] = $nombre_documento_sri;  
        }

        /*if ($request->hasFile('nombre_archivo_patrimonio')) {
            $nombre_documento_patrimonio = $this->storeArchivo($persona, $request->nombre_archivo_patrimonio, '-patrimonio');
            $perfil['nombre_archivo_patrimonio'] = $nombre_documento_patrimonio;  
        }*/

        if ($request->hasFile('nombre_archivo_compania')) {
            $nombre_documento_compania = $this->storeArchivo($persona, $request->nombre_archivo_compania, '-compania');
            $perfil['nombre_archivo_compania'] = $nombre_documento_compania;  
        }

        if ($request->hasFile('nombre_archivo_judicial')) {
            $nombre_documento_judicial = $this->storeArchivo($persona, $request->nombre_archivo_judicial, '-judicial');
            $perfil['nombre_archivo_judicial'] = $nombre_documento_judicial;  
        }

        if ($request->hasFile('nombre_archivo_penal')) {
            $nombre_documento_penal = $this->storeArchivo($persona, $request->nombre_archivo_penal, '-penal');
            $perfil['nombre_archivo_penal'] = $nombre_documento_penal;  
        }

        if ($request->hasFile('nombre_archivo_estudio')) {
            $nombre_documento_estudio = $this->storeArchivo($persona, $request->nombre_archivo_estudio, '-estudio');
            $perfil['nombre_archivo_estudio'] = $nombre_documento_estudio;  
        }

        if ($request->hasFile('nombre_archivo_contraloria')) {
            $nombre_documento_contralor = $this->storeArchivo($persona, $request->nombre_archivo_contraloria, '-contraloria');
            $perfil['nombre_archivo_contraloria'] = $nombre_documento_contralor;
        }

        Perfil::create($perfil);

        flash('El Perfil del '.$persona->nombres_persona.' '.$persona->apellidos_persona.' ha sido registrado.')->success();

        return redirect('/admin/perfiles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show($perfil_id)
    {
        $perfil = Perfil::find($perfil_id);
        return view('admin.perfil.show')->with(['perfil'=>$perfil]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($perfil_id)
    {
        $perfil = Perfil::find($perfil_id);
        $personas = Persona::all();
        return view('admin.perfil.edit')->with(['perfil'=>$perfil,'personas'=>$personas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $perfil_id)
    {
        $persona = Persona::find($request->persona_id); 
        $perfil = Perfil::find($perfil_id);
        $perfil->persona_id=$request->persona_id;
        $perfil->antecedentes_penales=$request->antecedentes_penales;
        $perfil->url_sri=$request->url_sri;
        $perfil->url_patrimonio=$request->url_patrimonio;
        $perfil->url_compania=$request->url_compania;
        $perfil->url_judicial=$request->url_judicial;
        $perfil->url_penal=$request->url_penal;
        $perfil->url_estudio=$request->url_estudio;
        $perfil->url_contraloria=$request->url_contraloria;
        $perfil->url_perfil=$request->url_perfil;
        $perfil->pensiones_alimenticias=$request->pensiones_alimenticias;
        $perfil->pensiones_alimenticias_fuente= $request->pensiones_alimenticias_fuente == "" ? null : $request->pensiones_alimenticias_fuente;

        if ($request->hasFile('picture')) {
            
            $picture_politico = $this->updateImagenPolitico($perfil, $request);
            $perfil->picture = $picture_politico;
        }

        if ($request->hasFile('nombre_archivo_sri')) {
            $this->destroyArchivo($perfil->nombre_archivo_sri);
            $nombre_documento_sri = $this->storeArchivo($persona, $request->nombre_archivo_sri, '-sri');
            $perfil->nombre_archivo_sri = $nombre_documento_sri;  
        }

        /*if ($request->hasFile('nombre_archivo_patrimonio')) {
            $this->destroyArchivo($perfil->nombre_archivo_patrimonio);
            $nombre_documento_patrimonio = $this->storeArchivo($persona, $request->nombre_archivo_patrimonio, '-patrimonio');
            $perfil->nombre_archivo_patrimonio = $nombre_documento_patrimonio;  
        }*/

        if ($request->hasFile('nombre_archivo_compania')) {
            $this->destroyArchivo($perfil->nombre_archivo_compania);
            $nombre_documento_compania = $this->storeArchivo($persona, $request->nombre_archivo_compania, '-compania');
            $perfil->nombre_archivo_compania = $nombre_documento_compania;  
        }

        if ($request->hasFile('nombre_archivo_judicial')) {
            $this->destroyArchivo($perfil->nombre_archivo_judicial);
            $nombre_documento_judicial = $this->storeArchivo($persona, $request->nombre_archivo_judicial, '-judicial');
            $perfil->nombre_archivo_judicial = $nombre_documento_judicial;  
        }

        if ($request->hasFile('nombre_archivo_penal')) {
            $this->destroyArchivo($perfil->nombre_archivo_penal);
            $nombre_documento_penal = $this->storeArchivo($persona, $request->nombre_archivo_penal, '-penal');
            $perfil->nombre_archivo_penal = $nombre_documento_penal;  
        }

        if ($request->hasFile('nombre_archivo_estudio')) {
            $this->destroyArchivo($perfil->nombre_archivo_estudio);
            $nombre_documento_estudio = $this->storeArchivo($persona, $request->nombre_archivo_estudio, '-estudio');
            $perfil->nombre_archivo_estudio = $nombre_documento_estudio;  
        }

        if ($request->hasFile('nombre_archivo_contraloria')) {
            $this->destroyArchivo($perfil->nombre_archivo_contraloria);
            $nombre_documento_contralor = $this->storeArchivo($persona, $request->nombre_archivo_contraloria, '-contraloria');
            $perfil->nombre_archivo_contraloria = $nombre_documento_contralor;
        }

        $perfil->save();

        flash('El Perfil del usuario '.$perfil->persona->nombres_persona.' '.$perfil->persona->apellidos_persona.' ha sido actualizado.')->info();

        return redirect('/admin/perfiles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy($perfil_id)
    {
        $perfil = Perfil::find($perfil_id);
        if (!is_null($perfil->picture)) {
            $this->deleteImagenPolitico($perfil);
           
        }
        if (!is_null($perfil->nombre_archivo_sri)) {
            $this->destroyArchivo($perfil->nombre_archivo_sri);
        }
        /*if (!is_null($perfil->nombre_archivo_patrimonio)) {
            $this->destroyArchivo($perfil->nombre_archivo_patrimonio);
        }*/
        if (!is_null($perfil->nombre_archivo_compania)) {
            $this->destroyArchivo($perfil->nombre_archivo_compania);
        }
        if (!is_null($perfil->nombre_archivo_judicial)) {
            $this->destroyArchivo($perfil->nombre_archivo_judicial);
        }
        if (!is_null($perfil->nombre_archivo_penal)) {
            $this->destroyArchivo($perfil->nombre_archivo_penal);
        }
        if (!is_null($perfil->nombre_archivo_estudio)) {
            $this->destroyArchivo($perfil->nombre_archivo_estudio);
        }
        if (!is_null($perfil->nombre_archivo_contraloria)) {
            $this->destroyArchivo($perfil->nombre_archivo_contraloria);
        }

        $perfil->delete();
    
        
        flash('El Perfil del usuario '.$perfil->persona->nombres_persona.' '.$perfil->persona->apellidos_persona.' ha sido eliminado.')->error();

        return redirect('/admin/perfiles');
    }

    public function storeArchivo($persona, $archivo_request,$tipo_documento){
        
        $nombreArchivo = strtotime("now").'_'.str_replace(" ", "_", $persona->nombres_persona.' '.$persona->apellidos_persona).$tipo_documento.'.'.$archivo_request->getClientOriginalExtension();
        
        Storage::disk('archivosFuentes')->put($nombreArchivo,file_get_contents($archivo_request->getRealPath()));

        $nombre_archivo_perfil = '/docs/fuentes/'.$nombreArchivo;

        return $nombre_archivo_perfil;
    }

    public function destroyArchivo($nombre_archivo){
        $ruta_archivo =  explode("/", $nombre_archivo);
        $nombre_documento = end( $ruta_archivo );
        Storage::disk('archivosFuentes')->delete($nombre_documento);
    }

    public function storeImagePolitico($datos_persona){
        $persona = Persona::find($datos_persona->persona_id);
        $nombre_persona = $this->nombrePolitico($persona);
        $imagen_perfil = $datos_persona->file('picture');
        $nombre_imagen = time().'-'.$nombre_persona.'.'.$imagen_perfil->getClientOriginalExtension();
        
        Image::make($imagen_perfil)->resize(300, 300)->save(public_path('/img/perfiles/'.$nombre_imagen));

        $nombre_imagen_politico = '/img/perfiles/'.$nombre_imagen;
       
        return $nombre_imagen_politico;

    }

    public function updateImagenPolitico($datos_persona,$datos_persona_update){
      $this->deleteImagenPolitico($datos_persona);
      $nombre_imagen_politico = $this->storeImagePolitico($datos_persona_update);
      return $nombre_imagen_politico;
    }

    public function deleteImagenPolitico($datos_persona){

      File::delete(public_path($datos_persona->picture));
    }

    public function nombrePolitico($datos_persona){
      $nombres_politico = explode(" ", $datos_persona->nombres_persona);
      $apellidos_politico = explode(" ", $datos_persona->apellidos_persona);
      return $nombres_politico[0].'-'.$apellidos_politico[0];
    }
}