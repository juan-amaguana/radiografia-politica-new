<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoria = Categoria::all();
        return view('admin.categoria.index')->with(['categoria'=>$categoria]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categoria = Categoria::all();
        return view('admin.categoria.create')->with(['categoria'=>$categoria]); 
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


        $categoria = new Categoria;
        $categoria->nombre_categoria =$request->nombre_categoria;
        $categoria->estado =$request->estado;
        $categoria->slug =$request->slug;
        $categoria->meta_description =$request->meta_description;
        $categoria->meta_keywords =$request->meta_keywords;
        $categoria->save();
        flash('La categoria  <strong>'.$categoria->nombre_categoria.'</strong> ha sido registrado exitosamente')->success();
        return redirect('/admin/categorias');
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
        //dd($id);
        $categoria = Categoria::find($id);
            
        return view('admin.categoria.edit')->with('categoria',$categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //

        //dd($categoria);
        $categoria->nombre_categoria =$request->nombre_categoria;
        $categoria->estado =$request->estado;
        $categoria->slug =$request->slug;
        $categoria->meta_description =$request->meta_description;
        $categoria->meta_keywords =$request->meta_keywords;
        $categoria->save();

        $categoria = Categoria::all();
        return redirect('/admin/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        flash('La categoria '.$categoria->nombre_categoria.' ha sido eliminado.')->error();
        return redirect('/admin/categorias');

    }
}
