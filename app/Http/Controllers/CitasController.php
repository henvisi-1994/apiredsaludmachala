<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas= DB::select('select * from v_citas');
        return $citas;

    }
    public function obtener_citas()
    {
        $citas = Citas::all();
        return response()->json($citas, 200);
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
            'id_especialidad' => 'required',
            'id_horario' => 'required',
            'id_medico' => 'required',
        ]);
        if ($v) {

            $cita = new Citas();
            $cita->id_especialidad = $request->input('id_especialidad');
            $cita->id_horario = $request->input('id_horario');
            $cita->id_medico = $request->input('id_medico');
            $cita->save();
            return redirect('citas');
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
            'id_especialidad' => 'required',
            'id_horario' => 'required',
            'id_medico' => 'required',
        ]);
        if ($v) {
            $cita = Citas::find($id)->firstOrFail();
            $cita->id_especialidad = $request->input('id_especialidad');
            $cita->id_horario = $request->input('id_horario');
            $cita->id_medico = $request->input('id_medico');
            DB::table('citas')
                ->where('id_cita', $id)
                ->update(
                    ['id_especialidad' => $cita->id_especialidad, 'id_horario' => $cita->id_horario, 'id_medico' => $cita->id_medico]
                );
            return redirect('citas');
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
        $citas = Citas::find($id);
        $citas->delete();
        //
    }
    public function citas()
    {
        return view('citas');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','citas']);
    }

}
