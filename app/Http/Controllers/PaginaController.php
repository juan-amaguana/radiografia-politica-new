<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use App\Models\Administracion;

class PaginaController extends Controller
{
    //

    public function datos_abiertos(){

        return view('datos_abiertos');
        
    }


    public function contacto(){
        $administracion = Administracion::all()->last();

    	return view('contacto')->with(['administracion'=>$administracion]);
    }

    public function quienesSomos(){
    	$administracion = Administracion::all()->last();

    	return view('quienes_somos')->with(['administracion'=>$administracion]);
    }


    public function sumateIniciativa(){
        return view('sumate_iniciativa');
    }

    public function colaborador(){
        return view('colaborador');
    }
}
