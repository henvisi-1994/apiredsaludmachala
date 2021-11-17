<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = DB::select('SELECT *from v_horarios where estado = :estado', ['estado' => 'true']);
        return $horarios;

    }
    public function obtener_horario()
    {
        $horarios= DB::select('select * from v_horarios');
        return response()->json($horarios, 200);
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
            'fecha' => 'required',
            'id_hora' => 'required',
            'id_medico' => 'required',
        ]);
        if ($v) {

            $horario = new Horarios();
            $horario->fecha = $request->input('fecha');
            $horario->id_hora = $request->input('id_hora');
            $horario->id_medico = $request->input('id_medico');
            $horario->estado = 'true';
            $horario->save();
            return redirect('horarios');
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
            'fecha' => 'required',
            'id_hora' => 'required',
            'id_medico' => 'required',
        ]);
        if ($v) {
            $horario = Horarios::find($id)->firstOrFail();
            $horario->fecha = $request->input('fecha');
            $horario->id_hora = $request->input('id_hora');
            $horario->id_medico = $request->input('id_medico');
            DB::table('horarios')
                ->where('id_horario', $id)
                ->update(
                    ['fecha' => $horario->fecha, 'id_hora' => $horario->id_hora, 'id_medico' => $horario->id_medico]
                );
            return redirect('horarios');
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
            $horario = Horarios::find($id)->firstOrFail();
            $horario->estado = 'false';
            DB::table('horarios')
                ->where('id_horario', $id)
                ->update(
                    ['estado' => $horario->estado]
                );
                return response()->json([
                    'mensaje' => "Horario Eliminada"
                ]);

    }
    public function horarios()
    {
        return view('horarios');
    }
        public function habilitar_horarios($id)
    {
        $horario = Horarios::find($id)->firstOrFail();
            $horario->estado = 'true';
            DB::table('horarios')
                ->where('id_horario', $id)
                ->update(
                    ['estado' => $horario->estado]
                );
                return response()->json([
                    'mensaje' => "Horario Eliminada"
                ]);

    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','horarios']);
    }

}