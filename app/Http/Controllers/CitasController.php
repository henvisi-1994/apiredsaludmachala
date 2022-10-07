<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use  App\Imports\CsvImport;
use App\Models\CentrosMedicos;
use App\Models\DetalleCentrosMedicos;
use App\Models\Especialidades;
use App\Models\Horarios;
use App\Models\Horas;
use App\Models\Medicos;
use App\Models\User;
class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = DB::select('select * from v_citas');
        return $citas;
    }
    public function obtener_citas()
    {
        $citas = DB::select('select * from v_citas');
        return $citas;
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
        $carbon = new \Carbon\Carbon();
        $v = $this->validate(request(), [
            'id_especialidad' => 'required',
            'id_horario' => 'required',
            'id_medico' => 'required',
        ]);
        //if ($v) {

        $cita = new Citas();
        $cita->id_especialidad = $request->input('id_especialidad');
        $cita->id_horario = $request->input('id_horario');
        $cita->id_medico = $request->input('id_medico');
        //$cita->nomb_usuario = $request->input('nomb_usuario');
        $cita->id_usuario = $request->input('id_usuario');

        $cita->save();
        return $cita;
        /*return response()->json([
                'mensaje' => "Cita Confirmada"
            ]);*/
        //} else {
        //     return back()->withInput($request->all());
        // }
    }
    public function email_cita(Request $request)
    {
        $cita=Citas::
        join('medicos', 'citas.id_medico', '=', 'medicos.id_medico')->
        join('detalle_centros_medicos','medicos.id_detalleCentroMed','=','detalle_centros_medicos.id_detalleCentroMed')->
        join('centros_medicos','detalle_centros_medicos.id_centroMedico','=','centros_medicos.id_centroMedico')->
        where("citas.id_medico",$request->input('id_medico'))->first();
        $email=$cita->email;
        $especialidad = $request->input('nombre_especialidad');
        $nomb_centro_medico = $request->input('nombre_centroMedico');
        $nomb_medico = $request->input('nombre_medico');
        $fecha = DB::select('SELECT fecha FROM v_citas where id_medico = :id', ['id' => $request->input('id_medico')])[0]->fecha;
        $date = Carbon::parse($fecha);
        $date = $date->format('d/m/Y');
        $hora = DB::select('SELECT hora FROM v_citas where id_medico = :id', ['id' => $request->input('id_medico')])[0]->hora;
        $formato_hora = explode("-", $hora);
        $nomb_usuario = $request->input('nomb_usuario');
        $credenciales = [
            'email' => $email,
            'username' =>  $nomb_usuario,
            'especialidad' => $especialidad,
            'nomb_centro_medico' => $nomb_centro_medico,
            'nomb_medico' => $nomb_medico,
            'fecha' => $date,
            'hora' => $formato_hora[0]
        ];
        Mail::send('email', $credenciales, function ($msj) use ($email, $nomb_usuario) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Agenda de Cita Medica');
        });
        return $credenciales;
    }
    public function email_comprobante(Request $request)
    {
        $email = $request->input('email');
        $especialidad = $request->input('nombre_especialidad');
        $nomb_medico = $request->input('nombre_medico');
        $fecha = Carbon::now();
        $date = Carbon::parse($fecha);
        $date = $date->format('d/m/Y');
        $cedula = $request->input('identificacion');
        $nomb_usuario = $request->input('nomb_usuario');
        $num_comprobante = $request->input('id');
        $precio = $request->input('amount');
        $hora = $request->input('hora');
        $auxhora = explode("-", $hora);
        $nomb_centMedico = $request->input('centroMedico');
        $fecha_cita = $request->input('fecha_cita');
        $auxFecha = Carbon::parse($fecha_cita);
        $num_autorizacion=$request->input('autorizacion');
        $credenciales = [
            'email' => $email,
            'username' =>  $nomb_usuario,
            'especialidad' => $especialidad,
            'nomb_medico' => $nomb_medico,
            'fecha' => $date,
            'identificacion' => $cedula,
            'num_comprobante' => $num_comprobante,
            'precio' => $precio,
            'auxhora' => $auxhora[0],
            'nomb_centMedico' => $nomb_centMedico,
            'auxFecha' => $auxFecha->format('d/m/Y'),
            'autorizacion'=>$num_autorizacion
        ];
        $nombre_archivo=$num_comprobante.'.pdf';
        $pdf = PDF::loadView('comprobante_pdf', $credenciales);
        $pdf->setPaper('a4', 'portrait');
        /*->save(storage_path('app/public/comprobante/') . $nombre_archivo);*/
        Mail::send('comprobante', $credenciales, function ($msj) use ($email, $nomb_usuario,$pdf,$nombre_archivo) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Comprobante de Cita Medica');
            $msj->attachData($pdf->output(),$nombre_archivo);
        });
        return $credenciales;
    }
    public function email_comprobante_ios($id_especialidad,
    $id_usuario,
    $id_horario,
    $id_medico,
    $identificacion,$id_detalleCentroMed,$autorizacion)
    {

        $especialidad_db=Especialidades::where('id_especialidad',$id_especialidad)->get()[0];
        $medico=Medicos::where('id_medico',$id_medico)->get()[0];
        $horario=Horarios::where('id_horario',$id_horario)->get()[0];
        $usuario=User::where('id',$id_usuario)->get()[0];
        $hora_db=Horas::where('id_hora',$horario->id_hora)->get()[0];
        $detalle=DetalleCentrosMedicos::where('id_detalleCentroMed',$id_detalleCentroMed)->get()[0];
        $centro_medico=CentrosMedicos::where('id_centroMedico',$detalle->id_centroMedico)->get()[0];
        $email = $usuario->email;
        $especialidad = $especialidad_db->nombre_especialidad;
        $nomb_medico = $medico->nombre_medico;
        $fecha = Carbon::now();
        $date = Carbon::parse($fecha);
        $date = $date->format('d/m/Y');
        $cedula = $usuario->identificacion;
        $nomb_usuario = $usuario->name;
        $num_comprobante = $identificacion;
        $precio = $especialidad_db->valor;
        $hora = $hora_db->hora;
        $auxhora = explode("-", $hora);
        $nomb_centMedico = $centro_medico->nombre_centroMedico;
        $fecha_cita = $horario->fecha;
        $auxFecha = Carbon::parse($fecha_cita);
        $num_autorizacion=$autorizacion;

        $credenciales = [
            'email' => $email,
            'username' =>  $nomb_usuario,
            'especialidad' => $especialidad,
            'nomb_medico' => $nomb_medico,
            'fecha' => $date,
            'identificacion' => $cedula,
            'num_comprobante' => $num_comprobante,
            'precio' => $precio,
            'auxhora' => $auxhora[0],
            'nomb_centMedico' => $nomb_centMedico,
            'auxFecha' => $auxFecha->format('d/m/Y'),
            'autorizacion'=>$num_autorizacion
        ];
        $nombre_archivo=$num_comprobante.'.pdf';
        $pdf = PDF::loadView('comprobante_pdf', $credenciales);
        $pdf->setPaper('a4', 'portrait');
        /*->save(storage_path('app/public/comprobante/') . $nombre_archivo);*/
        Mail::send('comprobante', $credenciales, function ($msj) use ($email, $nomb_usuario,$pdf,$nombre_archivo) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Comprobante de Cita Medica');
            $msj->attachData($pdf->output(),$nombre_archivo);
        });
        return $credenciales;
    }

    public function email_cita_ios($id_especialidad,$id_medico,$id_horario,
    $id_detalleCentroMed,
    $id_usuario)
    {
        $especialidad=Especialidades::where('id_especialidad',$id_especialidad)->get()[0];
        $medico=Medicos::where('id_medico',$id_medico)->get()[0];
        $horario=Horarios::where('id_horario',$id_horario)->get()[0];
        $detalle=DetalleCentrosMedicos::where('id_detalleCentroMed',$id_detalleCentroMed)->get()[0];
        $usuario=User::where('id',$id_usuario)->get()[0];
        $centro_medico=CentrosMedicos::where('id_centroMedico',$detalle->id_centroMedico)->get()[0];

        $email = $centro_medico->email;
        $especialidad = $especialidad->nombre_especialidad;
        $nomb_centro_medico = $centro_medico->nombre_centroMedico;
        $nomb_medico = $medico->nombre_medico;
        $fecha = DB::select('SELECT fecha FROM v_citas where id_medico = :id', ['id' => $id_medico])[0]->fecha;
        $date = Carbon::parse($fecha);
        $date = $date->format('d/m/Y');
        $hora = DB::select('SELECT hora FROM v_citas where id_medico = :id', ['id' => $id_medico])[0]->hora;
        $formato_hora = explode("-", $hora);
        $nomb_usuario = $usuario->name;
        $credenciales = [
            'email' => $email,
            'username' =>  $nomb_usuario,
            'especialidad' => $especialidad,
            'nomb_centro_medico' => $nomb_centro_medico,
            'nomb_medico' => $nomb_medico,
            'fecha' => $date,
            'hora' => $formato_hora[0]
        ];
        Mail::send('email', $credenciales, function ($msj) use ($email, $nomb_usuario) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Agenda de Cita Medica');
        });
        return $credenciales;
    }
    public function crearCita($id_especialidad,$id_horario,$id_medico,$id_usuario){
        $carbon = new \Carbon\Carbon();
        $cita = new Citas();
        $cita->id_especialidad = $id_especialidad;
        $cita->id_horario = $id_horario;
        $cita->id_medico = $id_medico;
        //$cita->nomb_usuario = $request->input('nomb_usuario');
        $cita->id_usuario = $id_usuario;
        $cita->save();
        return $cita;
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
    public function historial($id)
    {
        $historial = DB::select('SELECT * FROM v_citas where id_usuario = :id', ['id' => $id]);
        return $historial;
    }

    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index', 'citas','carga_masiva']);
    }

}
