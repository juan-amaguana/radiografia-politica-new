<?php

namespace App\Http\Controllers;

use App\Models\Administracion;
use Illuminate\Http\Request;
use Storage;
use File;

class AdministracionController extends Controller
{
    protected $rules = [
        'mision' => 'required',
        'email' => 'required',
        'key_word' => 'required', 
        'telefono' => 'required',
        'direccion' => 'required',
        'licencia' => 'required',
        'email_contacto_datos_abiertos' => 'required',
        'autor_datos_abiertos' => 'required',
        'imagen1' => 'mimes:png,jpg,jpeg,gif',
        'imagen2' => 'mimes:png,jpg,jpeg,gif',
        'imagen3' => 'mimes:png,jpg,jpeg,gif',
        
        
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administracion = Administracion::first();
        //dd($administracion);
        return view('admin.administracion.index')->with(['administracion'=>$administracion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $administracion = Administracion::first();
        //dd($administracion);
        if (is_null($administracion)) {
            //('creo uno nuevo');
           return view('admin.administracion.create');
        }else{
            //dd('editar');
            return redirect('/admin/administraciones/'.$administracion->id.'/edit');
        }
        
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
        //dd($request);
        $administracion = $request->all();
        
        $nombre_imagen1 = $this->storeArchivo( $request->imagen1,'administracionImagen1');
        $administracion['imagen1'] = $nombre_imagen1;

        $nombre_imagen2 = $this->storeArchivo( $request->imagen2,'administracionImagen2');
        $administracion['imagen2'] = $nombre_imagen2;

        $nombre_imagen3 = $this->storeArchivo( $request->imagen3,'administracionImagen3');
        $administracion['imagen3'] = $nombre_imagen3;

        /*$nombre_logo_movil = $this->storeArchivo( $request->logo_movil,'administracionLogoMovil');
        $administracion['logo_movil'] = $nombre_logo_movil;

        $nombre_logo_web = $this->storeArchivo( $request->logo_web,'administracionLogoWeb');
        $administracion['logo_web'] = $nombre_logo_web;*/
        
        Administracion::create($administracion);
        flash('La administracion ha sido registrada.')->success();

        return redirect('/admin/administraciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function show($administracion_id)
    {
        $administracion = Administracion::find($administracion_id);
        //dd($administracion);
        return view('admin.administracion.show')->with(['administracion'=>$administracion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function edit($administracion_id)
    {
        $administracion = Administracion::find($administracion_id);
        return view('admin.administracion.edit')->with(['administracion'=>$administracion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $administracion_id)
    {
        $this->validate(request(), [
        'mision' => 'required',
        
        'email' => 'required',
        'key_word' => 'required', 
        'telefono' => 'required',
        'direccion' => 'required',
        'licencia' => 'required',
        'email_contacto_datos_abiertos' => 'required',
        'autor_datos_abiertos' => 'required',
        'imagen1' => 'mimes:png,jpg,jpeg,gif',
        'imagen2' => 'mimes:png,jpg,jpeg,gif',
        'imagen3' => 'mimes:png,jpg,jpeg,gif',
        
        
        ]);

        $administracion = Administracion::find($administracion_id);
        $administracion->mision = $request->mision ;
        //$administracion->vision = $request->vision ;
        $administracion->email = $request->email ;
        $administracion->key_word = $request->key_word ;
        $administracion->telefono = $request->telefono ;
        $administracion->direccion = $request->direccion ;
        $administracion->licencia = $request->licencia ;
        $administracion->email_contacto_datos_abiertos = $request->email_contacto_datos_abiertos ;
        $administracion->autor_datos_abiertos = $request->autor_datos_abiertos ;
        //$administracion->descripcion_logo_movil = $request->descripcion_logo_movil ;
        //$administracion->descripcion_logo_web = $request->descripcion_logo_web ;
        if ($request->hasFile('imagen1')) {
            $this->destroyArchivo($administracion->imagen1,'administracionImagen1');
            $nombre_imagen1 = $this->storeArchivo($request->imagen1,'administracionImagen1');
            $administracion->imagen1 = $nombre_imagen1;
        }

        if ($request->hasFile('imagen2')) {
            $this->destroyArchivo($administracion->imagen2,'administracionImagen2');
            $nombre_imagen2 = $this->storeArchivo($request->imagen2,'administracionImagen2');
            $administracion->imagen2 = $nombre_imagen2;
        }

        if ($request->hasFile('imagen3')) {
            $this->destroyArchivo($administracion->imagen3,'administracionImagen3');
            $nombre_imagen3 = $this->storeArchivo($request->imagen3,'administracionImagen3');
            $administracion->imagen3 = $nombre_imagen3;
        }

        /*if ($request->hasFile('logo_movil')) {
            $this->destroyArchivo($administracion->logo_movil,'administracionLogoMovil');
            $nombre_logo_movil = $this->storeArchivo($request->logo_movil,'administracionLogoMovil');
            $administracion->logo_movil = $nombre_logo_movil;
        }

        if ($request->hasFile('logo_web')) {
            $this->destroyArchivo($administracion->logo_web,'administracionLogoWeb');
            $nombre_logo_web = $this->storeArchivo($request->logo_web,'administracionLogoWeb');
            $administracion->logo_web = $nombre_logo_web;
        }*/
        $administracion->save();

        flash('La administracion ha sido actualizada.')->info();

        return redirect('/admin/administraciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function destroy($administracion_id)
    {
        $administracion = Administracion::find($administracion_id);
        $this->destroyArchivo($administracion->imagen1,'administracionImagen1');
        $this->destroyArchivo($administracion->imagen2,'administracionImagen2');
        $this->destroyArchivo($administracion->imagen3,'administracionImagen3');
        $this->destroyArchivo($administracion->logo_movil,'administracionLogoMovil');
        $this->destroyArchivo($administracion->logo_web,'administracionLogoWeb');
        $administracion->delete();
        flash('La administracion ha sido eliminada.')->error();

        return redirect('/admin/administraciones');
    }

    public function storeArchivo($archivo_request,$storage){

        
        $nombreArchivo = strtotime("now").'_'.str_replace(" ", "_", $archivo_request->getClientOriginalName()).'.'.$archivo_request->getClientOriginalExtension();
        
        Storage::disk($storage)->put($nombreArchivo,file_get_contents($archivo_request->getRealPath()));

        return $nombreArchivo;
    }

    public function destroyArchivo($nombre_archivo, $storage){
        Storage::disk($storage)->delete($nombre_archivo);
    }


    public function obtenerMetaDatos(){
        return Administracion::metaDatosApi();
    }
}
