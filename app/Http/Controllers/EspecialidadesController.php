<?php

namespace App\Http\Controllers;

use App\Models\DetalleCentrosMedicos;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;



class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cache::has('especialidades')) {
            $especialidades = Cache::get('especialidades');
        } else {
            $especialidades = DB::select('select * from especialidades');
            Cache::put('especialidades', $especialidades);
        }


        return $especialidades;
    }
    public function obtener_especialidad($id_especialidad)
    {

        $especialidades = Especialidades::where('id_especialidad',$id_especialidad)->first();
        return $especialidades;
    }
	public function especialidad_cm($id_centroMedico)
    {
        $especialidades = DetalleCentrosMedicos::where('id_centroMedico',$id_centroMedico)->join('especialidades', 'detalle_centros_medicos.id_especialidad', '=', 'especialidades.id_especialidad')->get();
        //$especialidades = DetalleCentrosMedicos::where('id_centroMedico',$id_centroMedico)->get();
        return $especialidades;
    }


    public function obtener_especialidades()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades, 200);
    }
        public function obtener_especialidades_med_prod()
    {
        if (Cache::has('especialidades_med_prod')) {
            $especialidades = Cache::get('especialidades_med_prod');
        } else {
            $especialidades = DB::select('select DISTINCT nombre_especialidad, id_especialidad from v_medico_prod');
            Cache::put('especialidades_med_prod', $especialidades);
        }
        return $especialidades;
    }
    public function obtener_especialidades_med_prod2()
    {

        $especialidades = DB::select('select DISTINCT nombre_especialidad, id_especialidad from v_medico_prod');
        return $especialidades;
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
            'nombre_especialidad' => 'required|string',
            'valor' => 'required',

        ]);
        if ($v) {

            $especialidad = new Especialidades();
            $especialidad->nombre_especialidad = $request->input('nombre_especialidad');
            $especialidad->valor = $request->input('valor');
            $especialidad->save();
            return redirect('especialidades');
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
            'nombre_especialidad' => 'required|string',
            'valor' => 'required'
        ]);
        if ($v) {
            $especialidad = Especialidades::find($id)->firstOrFail();
            $especialidad->nombre_especialidad = $request->input('nombre_especialidad');
            $especialidad->valor = $request->input('valor');
            DB::table('especialidades')
                ->where('id_especialidad', $id)
                ->update(
                    ['nombre_especialidad' => $especialidad->nombre_especialidad, 'valor' => $especialidad->valor]
                );
            return redirect('especialidades');
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
        $detalle_especialidad = DB::select('SELECT *from detalle_centros_medicos where id_especialidad = :id', ['id' => $id]);
        $medico_produccion = DB::select('SELECT *from medico_produccions where id_especialidad = :id', ['id' => $id]);
        $size_especialidad = count($detalle_especialidad);
        $size_medico_prod = count($medico_produccion);
        if ($size_especialidad == 0 && $size_medico_prod == 0) {
            $especialidad = Especialidades::find($id);
            $especialidad->delete();
        } else {
            return response()->json("Especialidad Existente, No puede Eliminar");
        }
        //
    }
    public function especialidades()
    {
        return view('especialidades');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index', 'especialidades','obtener_especialidades_med_prod','obtener_especialidades_med_prod2','especialidad_cm','obtener_especialidad']);
    }
}
