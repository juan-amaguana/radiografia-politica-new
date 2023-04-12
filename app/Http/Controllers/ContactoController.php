<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    protected $rules = [
        'nombre_contacto' => 'required|max:60',
        'email_contacto' => 'required',
        'telefono_contacto' => 'digits:10|numeric',
        'asunto_contacto' => 'required|max:60',
        'mensaje_contacto' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos_observatorio = Contacto::orderBy('id', 'DESC')->paginate(8);
        //dd($contactos_observatorio);
        return view('admin.email.index')->with(['contactos_observatorio'=>$contactos_observatorio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $contacto = $request->all();

        $contacto_registro = Contacto::create($contacto);
        //dd($contacto_registro);
        flash('Felicidades '.$contacto_registro['nombre_contacto'].' su mensaje ha sido enviado.')->success();

        
        return redirect('/contactanos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show($contacto_id)
    {
        //dd($contacto);
        $contacto = Contacto::find($contacto_id);
        return view('admin.email.show')->with(['contacto'=>$contacto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        //
    }
}
