<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patrimonio;
use Storage;
use File;

class ArchivosDownloadController extends Controller
{
    public function descargarCurriculum($archivo){
    	$storage_path = storage_path('app').'/storage/docs/curriculum';
    	$url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
    	if (Storage::disk('archivosCurriculum')->exists($archivo))
    	{
    		return response()->download($url);
    	}
     //si no se encuentra lanzamos un error 404.
    	abort(404);
    }

    public function descargarPlan($archivo){
    	$storage_path = storage_path('app').'/storage/docs/plan';
    	$url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
    	if (Storage::disk('archivosPlan')->exists($archivo))
    	{
    		return response()->download($url);
    	}
     //si no se encuentra lanzamos un error 404.
    	abort(404);
    }

    public function descargarFuente($archivo){
        $storage_path = storage_path('app').'/storage/docs/fuentes';
        $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
        if (Storage::disk('archivosFuentes')->exists($archivo))
        {
            return response()->download($url);
        }
     //si no se encuentra lanzamos un error 404.
        abort(404);
    }

    public function descargarPatrimonio($archivo){
        $storage_path = storage_path('app').'/storage/docs/patrimonio';
        $url = $storage_path.'/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
        if (Storage::disk('archivosPatrimonio')->exists($archivo))
        {
            return response()->download($url);
        }
     //si no se encuentra lanzamos un error 404.
        abort(404);
    }
 
    public function cambiar(){
        $patrimonios = Patrimonio::whereNotNull('nombre_archivo_patrimonio1')->where('id','>',93)->get();
        foreach ($patrimonios as $patrimonio) {
            //dd($patrimonio,'-fuentespatrimonio.','-patrimoniopatrimonio.');
            $nueva_ruta = str_replace("-patrimoniopatrimonio.", "-fuentespatrimonio.", $patrimonio->nombre_archivo_patrimonio1);
            $edit_patrimonio = Patrimonio::find($patrimonio->id);
            $edit_patrimonio->nombre_archivo_patrimonio1 = $nueva_ruta;
            $edit_patrimonio->save();

        }

        return 'archivos actualizados';
        
    }
}
