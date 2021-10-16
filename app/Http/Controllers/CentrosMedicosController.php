<?php

namespace App\Http\Controllers;

use App\Models\CentrosMedicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CentrosMedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros_medicos = DB::select('select * from centros_medicos');
        return $centros_medicos;

    }
    public function obtener_centros_medicos()
    {
        $centros_medicos = CentrosMedicos::all();
        return response()->json($centros_medicos, 200);
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
            'nombre_centroMedico' => 'required|string',
            'direccion_centroMedico' => 'required|string',
            'telef_centroMedico' => 'required|string',
            'ubic_centroMedico' => 'required|string',
            'email' => 'required|string',
        ]);
        if ($v) {

            $centro_medico = new CentrosMedicos();
            $centro_medico->nombre_centroMedico = $request->input('nombre_centroMedico');
            $centro_medico->direccion_centroMedico = $request->input('direccion_centroMedico');
            $centro_medico->telef_centroMedico = $request->input('telef_centroMedico');
            $centro_medico->ubic_centroMedico = $request->input('ubic_centroMedico');
            $centro_medico->email = $request->input('email');
            $centro_medico->save();
            $data = CentrosMedicos::latest('id_centroMedico')->first();
            return $data;
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
            'nombre_centroMedico' => 'required|string',
            'direccion_centroMedico' => 'required|string',
            'telef_centroMedico' => 'required|string',
            'ubic_centroMedico' => 'required|string',
            'email' => 'required|string',
        ]);
        if ($v) {
            $centro_medico = CentrosMedicos::find($id)->firstOrFail();
            $centro_medico->nombre_centroMedico = $request->input('nombre_centroMedico');
            $centro_medico->direccion_centroMedico = $request->input('direccion_centroMedico');
            $centro_medico->ubic_centroMedico = $request->input('ubic_centroMedico');
            $centro_medico->telef_centroMedico = $request->input('telef_centroMedico');
            $centro_medico->email = $request->input('email');
            DB::table('centros_medicos')
                ->where('id_centroMedico', $id)
                ->update(
                    ['nombre_centroMedico' => $centro_medico->nombre_centroMedico, 'direccion_centroMedico' => $centro_medico->direccion_centroMedico, 'ubic_centroMedico' => $centro_medico->ubic_centroMedico, 'telef_centroMedico' => $centro_medico->telef_centroMedico, 'email' => $centro_medico->email]
                );
            return redirect('centrosmedicos');
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
        $centro_medico = CentrosMedicos::find($id);
        $centro_medico->delete();
        //
    }
    public function centros_medicos()
    {
        return view('centrosmedicos');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','centrosmedicos']);
    }

}
