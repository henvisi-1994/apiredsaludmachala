<?php

namespace App\Http\Controllers;

use App\Models\MedicoProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MedicoProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos_prod= DB::select('select *from v_medico_prod');
        return $medicos_prod;

    }
    public function obtener_medicos_prod()
    {
        $medicos_prod= DB::select('select *from v_medico_prod');
        return response()->json($medicos_prod, 200);
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
            'nomb_medico' => 'required|string',
            'id_especialidad' => 'required',
        ]);
        if ($v) {

            $medico_prod = new MedicoProduccion();
            $medico_prod->id_especialidad = $request->input('id_especialidad');
            $medico_prod->nomb_medico = $request->input('nomb_medico');
            $medico_prod->save();
            return ;
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
            'nomb_medico' => 'required|string',
            'id_especialidad' => 'required',
        ]);
        if ($v) {
            $medico_prod = MedicoProduccion::find($id)->firstOrFail();
            $medico_prod->id_especialidad = $request->input('id_especialidad');
            $medico_prod->nomb_medico = $request->input('nomb_medico');
            DB::table('medico_produccions')
                ->where('id_medico_prod', $id)
                ->update(
                    ['id_especialidad' => $medico_prod->id_especialidad, 'nomb_medico' => $medico_prod->nomb_medico]
                );
            return ;
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
        $medico_prod = MedicoProduccion::find($id);
        $medico_prod->delete();
        //
    }
    public function medico_prod()
    {
        return view('medico_prod');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','medico_prod']);
    }

}
