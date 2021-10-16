<?php

namespace App\Http\Controllers;

use App\Models\Medicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos= DB::select('select * from v_medicos');
        return $medicos;

    }
    public function obtener_medicos()
    {
        $medicos= DB::select('select * from v_medicos');
        return response()->json($medicos, 200);
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
            'tipo_medico' => 'required|string',
            'id_detalleCentroMed' => 'required',
            'nombre_medico' => 'required|string',
        ]);
        if ($v) {

            $medico = new Medicos();
            $medico->tipo_medico = $request->input('tipo_medico');
            $medico->id_detalleCentroMed = $request->input('id_detalleCentroMed');
            $medico->nombre_medico = $request->input('nombre_medico');
            $medico->save();
            return redirect('medicos');
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
            'tipo_medico' => 'required|string',
            'id_detalleCentroMed' => 'required',
            'nombre_medico' => 'required|string',
        ]);
        if ($v) {
            $medico = Medicos::find($id)->firstOrFail();
            $medico->tipo_medico = $request->input('tipo_medico');
            $medico->id_detalleCentroMed = $request->input('id_detalleCentroMed');
            $medico->nombre_medico = $request->input('nombre_medico');
            DB::table('medicos')
                ->where('id_medico', $id)
                ->update(
                    ['tipo_medico' => $medico->tipo_medico, 'id_detalleCentroMed' => $medico->id_detalleCentroMed, 'nombre_medico' => $medico->nombre_medico]
                );
            return redirect('medicos');
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
        $medicos = Medicos::find($id);
        $medicos->delete();
        //
    }
    public function medicos()
    {
        return view('medicos');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','medicos']);
    }

}
