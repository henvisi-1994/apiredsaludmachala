<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;




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
        $cita->nomb_usuario = $request->input('nomb_usuario');
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
        $email = DB::select('select email from citas inner join medicos on citas.id_medico=medicos.id_medico inner join detalle_centros_medicos on
            medicos."id_detalleCentroMed"=detalle_centros_medicos."id_detalleCentroMed" inner join centros_medicos on
            detalle_centros_medicos."id_centroMedico"=centros_medicos."id_centroMedico" where citas.id_medico = :id', ['id' => $request->input('id_medico')])[0]->email;
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
            'auxFecha' => $auxFecha->format('d/m/Y')
        ];
        Mail::send('comprobante', $credenciales, function ($msj) use ($email, $nomb_usuario) {
            $msj->to($email, $nomb_usuario);
            $msj->subject('Comprobante de Cita Medica');
        });
        return $credenciales;
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
        $this->middleware('auth:sanctum')->except(['index', 'citas']);
    }
}
