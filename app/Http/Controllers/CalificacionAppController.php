<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalificacionApp;
use Illuminate\Support\Facades\DB;

class CalificacionAppController extends Controller
{
    public function store(Request $request)
    {
            $id=$request->input('id_cita');
            $calificacion_app=CalificacionApp::where('id_cita',$request->input('id_cita'))->get();
            if(count($calificacion_app)<1){
                $calificacion_app = new CalificacionApp();
                $calificacion_app->id_cita = $request->input('id_cita');
                $calificacion_app->calificacion = $request->input('calificacion');
                $calificacion_app->comentario = $request->input('comentario');
                $calificacion_app->save();
                return $calificacion_app;
            }else{
                $califica = CalificacionApp::find($id)->firstOrFail();
                $califica->calificacion = $request->input('calificacion');
                $califica->comentario = $request->input('comentario');
                DB::table('calificacion')
                ->where('id_calificacion', $id)
                ->update(
                    ['calificacion' => $califica->calificacion, 'comentario' => $califica->comentario]
                );
                return $calificacion_app;
            }
    }
    public function index(){
        $calificaciones = DB::select('select calificacion.id_cita,calificacion,comentario,nombre_medico,nombre_especialidad,"nombre_centroMedico",fecha,hora from calificacion
        inner join v_citas on calificacion.id_cita=v_citas.id_cita');
        return $calificaciones;
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum');
    }
}
