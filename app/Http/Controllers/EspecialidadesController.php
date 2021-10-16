<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = DB::select('select * from especialidades');
        return $especialidades;

    }
    public function obtener_especialidades()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades, 200);
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
        ]);
        if ($v) {

            $especialidad = new Especialidades();
            $especialidad->nombre_especialidad = $request->input('nombre_especialidad');
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
        ]);
        if ($v) {
            $especialidad = Especialidades::find($id)->firstOrFail();
            $especialidad->nombre_especialidad = $request->input('nombre_especialidad');
            DB::table('especialidades')
                ->where('id_especialidad', $id)
                ->update(
                    ['nombre_especialidad' => $especialidad->nombre_especialidad]
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
        $especialidad = Especialidades::find($id);
        $especialidad->delete();
        //
    }
    public function especialidades()
    {
        return view('especialidades');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','especialidades']);
    }

}
