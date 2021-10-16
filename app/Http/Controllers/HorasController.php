<?php

namespace App\Http\Controllers;

use App\Models\Horas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horas= DB::select('select * from horas');
        return $horas;

    }
    public function obtener_horas()
    {
        $horas = Horas::all();
        return response()->json($horas, 200);
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
            'hora' => 'required|string',
        ]);
        if ($v) {

            $hora = new Horas();
            $hora->hora = $request->input('hora');
            $hora->save();
            return redirect('horas');
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
            'hora' => 'required|string',
        ]);
        if ($v) {
            $hora = Horas::find($id)->firstOrFail();
            $hora->hora = $request->input('hora');
            DB::table('horas')
                ->where('id_hora', $id)
                ->update(
                    ['hora' => $hora->hora]
                );
            return redirect('horas');
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
        $horas = Horas::find($id);
        $horas->delete();
        //
    }
    public function horas()
    {
        return view('horas');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','horas']);
    }

}
