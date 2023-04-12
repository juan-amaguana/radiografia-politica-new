<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delito;

use Auth;


class TipoDelitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipo_delito = Delito::all();
        return view('admin.tipo_delito.index')->with(['tipo_delito'=>$tipo_delito]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipo_delito = Delito::all();
        return view('admin.tipo_delito.create')->with(['tipo_delito'=>$tipo_delito]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);

        $tipo_delito = new Delito;
        $tipo_delito->nombre_tipo_delito =$request->nombre_tipo_delito;
        $tipo_delito->user_id = $request->user_id;
        //$categoria->estado =$request->estado;
        
        $tipo_delito->save();
        //flash('El  <strong>'.$categoria->nombre_categoria.'</strong> ha sido registrado exitosamente')->success();
        return redirect('/admin/tipo_delitos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tipo_delito = Delito::find($id);
            
        return view('admin.tipo_delito.edit')->with(['tipo_delito'=>$tipo_delito]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delito $tipo_delito)
    {
        //
       // dd($tipo_delito);
        $tipo_delito->nombre_tipo_delito =$request->nombre_tipo_delito;
        $tipo_delito->save();

        $tipo_delito = Delito::all();
        return view('admin.tipo_delito.index')->with(['tipo_delito'=>$tipo_delito]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
