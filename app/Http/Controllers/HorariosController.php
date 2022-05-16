<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Horas;
use App\Models\Citas;



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
        $cita=Citas::where('id_horario',$id)->get();
        if(count($cita)==0){
            $horario->delete();
        }
        else{
            $horario->estado = 'false';
            DB::table('horarios')
                ->where('id_horario', $id)
                ->update(
                    ['estado' => $horario->estado]
                );
        }
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
    public function carga_masiva(Request $request){
        $decodificado = base64_decode($request->csv_file);
        $archivos=[];

        $str = mb_convert_encoding($decodificado, "UTF-8");
        $archivo=explode(",",$str);
        for ($i=0; $i <count($archivo)-1 ; $i++) {
            array_push($archivos,$this->limpieza($archivo[$i]));
        }
        foreach ($archivos as &$valor) {
            $this->guardar_turno($valor,$request->id_medico);
        }

        return response()->json([
            'mensaje' => "Se ha guardado exitosamente"
        ]);

    }
    public function limpieza($data){
        if(stristr($data, 'u?Zj?e?ƭ????wf??\zV') === FALSE) {
            $limpiar=explode("\r\n",$data);
            return $limpiar[1];
        }else{
            $limpiar=explode("u?Zj?e?ƭ????wf??\zV",$data);
            return explode("ڱ?",$limpiar[1])[1];
        }
    }
    public function guardar_turno($data,$id_medico){
            $pos=explode(";",$data);
            $id_hora=$this->busqueda_horario($pos[0])->id_hora;
            $fecha=$pos[1];
            $horario = new Horarios();
            $horario->fecha = $fecha;
            $horario->id_hora = $id_hora;
            $horario->id_medico = $id_medico;
            $horario->estado = 'true';
            $horario->save();
    }
    public function busqueda_horario($data){
        $horario = Horas::where('hora',$data)->first();
        return $horario;

    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','horarios','carga_masiva']);
    }

}
