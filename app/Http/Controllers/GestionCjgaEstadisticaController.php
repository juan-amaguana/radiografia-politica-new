<?php

namespace App\Http\Controllers;

use App\GestionCjgaEstadistica;
use App\Provincia;
use App\Organizacion;
use Illuminate\Http\Request;

class GestionCjgaEstadisticaController extends Controller
{
    protected $rules = [
        'total_asesorias' => 'required|numeric|min:0',
        'total_patrocinios' => 'required|numeric|min:0',
        'anio' => 'required|numeric|min:0',
        'provincia' => 'required',
        'organizacion' => 'required',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadisticas = GestionCjgaEstadistica::all();
        return view('admin.cjga_estadistica.index')->with(['estadisticas' => $estadisticas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::all();
        $organizaciones = Organizacion::all();
        return view('admin.cjga_estadistica.create')->with(['provincias' => $provincias, 'organizaciones' => $organizaciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $estadistica_cjga = new GestionCjgaEstadistica;
        $estadistica_cjga->total_asesorias = $request->total_asesorias;
        $estadistica_cjga->total_patrocinios = $request->total_patrocinios;
        $estadistica_cjga->total_consultorios = $request->total_consultorios;
        $estadistica_cjga->provincia_id = $request->provincia;
        $estadistica_cjga->organizacion_id = $request->organizacion;
        $estadistica_cjga->anio = $request->anio;

        $estadistica_cjga->save();

        flash('La estadística CJGA para la organización ' . $estadistica_cjga->organizacion->nombre_organizacion . ' a sido registrada exitosamente.')->success();

        return redirect('/admin/CjgaEstadisticas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GestionCjgaEstadistica $gestionCjgaEstadistica
     * @return \Illuminate\Http\Response
     */
    public function show(GestionCjgaEstadistica $gestionCjgaEstadistica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GestionCjgaEstadistica $gestionCjgaEstadistica
     * @return \Illuminate\Http\Response
     */
    public function edit($gestionCjgaEstadistica_id)
    {
        $gestionCjgaEstadistica = GestionCjgaEstadistica::find($gestionCjgaEstadistica_id);
        $provincias = Provincia::all();
        $organizaciones = Organizacion::all();
        return view('admin.cjga_estadistica.edit')->with(['provincias' => $provincias, 'organizaciones' => $organizaciones, 'gestionCjgaEstadistica' => $gestionCjgaEstadistica]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\GestionCjgaEstadistica $gestionCjgaEstadistica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gestionCjgaEstadistica_id)
    {
        $gestionCjgaEstadistica = GestionCjgaEstadistica::find($gestionCjgaEstadistica_id);
        $gestionCjgaEstadistica->total_asesorias = $request->total_asesorias;
        $gestionCjgaEstadistica->total_patrocinios = $request->total_patrocinios;
        $gestionCjgaEstadistica->total_consultorios = $request->total_consultorios;
        $gestionCjgaEstadistica->provincia_id = $request->provincia;
        $gestionCjgaEstadistica->organizacion_id = $request->organizacion;
        $gestionCjgaEstadistica->anio = $request->anio;
        $gestionCjgaEstadistica->save();

        flash('La estadística CJGA para la organización ' . $gestionCjgaEstadistica->organizacion->nombre_organizacion . ' a sido actualizada.')->info();

        return redirect('/admin/CjgaEstadisticas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GestionCjgaEstadistica $gestionCjgaEstadistica
     * @return \Illuminate\Http\Response
     */
    public function destroy($gestionCjgaEstadistica_id)
    {
        $gestionCjgaEstadistica = GestionCjgaEstadistica::find($gestionCjgaEstadistica_id);
        $gestionCjgaEstadistica->delete();

        flash('La estadística CJGA para la organización ' . $gestionCjgaEstadistica->organizacion->nombre_organizacion . ' a sido eliminada.')->error();

        return redirect('/admin/CjgaEstadisticas');
    }

    public function obtenerConteoAsesoriaPatrocinios()
    {
        return GestionCjgaEstadistica::obtenerConteoAsesoriaPatrocinios();
    }

    public function obtenerAsesoriasPatrociniosProvincia($provincia_id)
    {
        return GestionCjgaEstadistica::obtenerAsesoriasPatrociniosProvincia($provincia_id);
    }

    public function gestionConsultorioProvincia($anio, $provincia_id)
    {
        return GestionCjgaEstadistica::gestionConsultorioProvincia($anio, $provincia_id);
    }

    public function gestionConsultorioNacionalProvincia($anio, $provincia_id = null)
    {
        $totalConsultoriosProvinciales = 0;
        $data['provincial'] = ($provincia_id) ? self::obtenerTotalesProvincial($anio, $provincia_id, $totalConsultoriosProvinciales) : self::obtenerTotalesNacional($anio, $totalConsultoriosProvinciales);
        $data['total-consultorios-provincial'] = $totalConsultoriosProvinciales;

        $detalle = self::obtenerDetalleOrganizaciones($anio, $provincia_id) ?? [];
        $data['detalle-html'] = view('public.estadisticas.includes.detalle-organizacion-provincia', ['detalle' => $detalle])->render();

        return $data;
    }

    public function obtenerTotalesNacional($anio, &$totalConsultoriosNacionales = 0)
    {
        $data = [];
        if ($nacional = GestionCjgaEstadistica::gestionConsultorioTotalesNacionalxAnio($anio)) {
            $totalConsultoriosNacionales = $nacional->total_consultorios;
            $data = [
                [
                    'data' => 'Asesorias',
                    'total' => $nacional->total_asesorias,
                ],
                [
                    'data' => 'Patrocinios',
                    'total' => $nacional->total_patrocinios,
                ]
            ];
        }

        return $data;
    }

    public function obtenerTotalesProvincial($anio, $provincia, &$totalConsultoriosProvinciales = 0)
    {
        $data = [];
        if ($db = GestionCjgaEstadistica::gestionConsultorioTotalesProvincialxAnio($anio, $provincia)) {
            $totalConsultoriosProvinciales = $db->total_consultorios;
            $data = [
                [
                    'data' => 'Asesorias',
                    'total' => $db->total_asesorias,
                ],
                [
                    'data' => 'Patrocinios',
                    'total' => $db->total_patrocinios,
                ]
            ];
        }

        return $data;
    }

    public function obtenerDetalleOrganizaciones($anio, $provincia_id)
    {
        $data = [];
        if ($consultorios = self::unificarConsultoriosMateria($anio, $provincia_id)) {
            foreach ($consultorios as $consultorio) {
                $data[] = [
                    'nombre' => $consultorio->nombre,
                    'nombre_organizacion' => $consultorio->nombre_organizacion,
                    'nombre_consultorio_juridico' => $consultorio->nombre_consultorio_juridico,
                    'direccion_consultorio_juridico' => $consultorio->direccion_consultorio_juridico,
                    'materias_derecho' => $consultorio->materias_derecho,
                ];
            }
        }

        return $data;
    }

    public function unificarConsultoriosMateria($anio, $provincia_id)
    {
        $data = $materias = [];
        if ($consultorios = GestionCjgaEstadistica::gestionConsultorioOrganizacionesxAnio($anio, $provincia_id)) {
            foreach ($consultorios as $consultorio) {
                $data[$consultorio->id] = $consultorio;
                $materias[$consultorio->id][] = $consultorio->nombre_materia;
            }

            foreach ($data as $key => $item) {
                if (isset($materias[$key])) {
                    $data[$key]['materias_derecho'] = $materias[$key];
                }
            }
        }

        ksort($data);
        return $data;
    }
}
