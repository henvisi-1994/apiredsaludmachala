<?php

namespace App\Http\Controllers;

use App\Models\DetalleCentrosMedicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;



class DetalleCentroMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cache::has('detalle_centro_medico')) {
            $detalle_centro_medico = Cache::get('detalle_centro_medico');
        } else {
            $detalle_centro_medico = DB::select('select * from v_detalle_centros_medicos');
            Cache::put('detalle_centro_medico', $detalle_centro_medico);
        }
        return $detalle_centro_medico;
    }
    public function obtener_detalle_centro_medicos()
    {
        $detalles_centros_medicos = DB::select('select * from v_detalle_centros_medicos');
        return response()->json($detalles_centros_medicos, 200);
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
        $v = $this->validate(request(), [
            'id_centroMedico' => 'required',
            'id_especialidad' => 'required',
        ]);
        if ($v) {

            $detalle_centro_medico = new DetalleCentrosMedicos();
            $detalle_centro_medico->id_centroMedico = $request->input('id_centroMedico');
            $detalle_centro_medico->id_especialidad = $request->input('id_especialidad');
            $detalle_centro_medico->save();
            return;
        } else {
            return back()->withInput($request->all());
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = ' ';
        $ruta = ' ';
        $v = $this->validate(request(), [
            'id_centroMedico' => 'required',
            'id_especialidad' => 'required',
        ]);
        if ($v) {
            $detalle_centro_medico = DetalleCentrosMedicos::find($id)->firstOrFail();
            $detalle_centro_medico->id_centroMedico = $request->input('id_centroMedico');
            $detalle_centro_medico->id_especialidad = $request->input('id_especialidad');
            DB::table('detalle_centros_medicos')
                ->where('id_detalleCentroMed', $id)
                ->update(
                    ['id_centroMedico' => $detalle_centro_medico->id_centroMedico, 'id_especialidad' => $detalle_centro_medico->id_especialidad]
                );
            return;
        } else {
            return back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle_centro_medico = DetalleCentrosMedicos::find($id);
        $detalle_centro_medico->delete();
        //
    }
    public function detalle_centros_medicos()
    {
        return view('detallecentrosmedicos');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index', 'detallecentrosmedicos']);
    }
}
