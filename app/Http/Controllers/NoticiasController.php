<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = DB::select('select * from v_control_fecha');
        return $noticias;

    }
    public function all()
    {
        $noticia = Noticias::all();
        return response()->json($noticia, 200);
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
            'titulo_noticia' => 'required|string',
            'imagen_noticia' => 'required|string',
            'descripcion_noticia' => 'required|string',
            'fecha_inicio_noticia' => 'required',
            'fecha_fin_noticia' => 'required'
        ]);
        if ($v) {
            list($type, $imageData) = explode(';', $request->imagen_noticia);
            list(, $extension) = explode('/', $type);
            list(, $imageData) = explode(',', $imageData);
            $name = $request->titulo_noticia.Carbon::now()->timestamp . '.' . $extension;
            $source = fopen($request->imagen_noticia, 'r');
            $destination = fopen('/home/saludmac/apiapp.saludmachala.gob.ec/img/noticia/' . $name, 'w');
            stream_copy_to_stream($source, $destination);

            fclose($source);
            fclose($destination);
            $ruta = '/img/noticia/';
            $noticia = new Noticias();
            $noticia->titulo_noticia = $request->input('titulo_noticia');
            $noticia->imagen_noticia = $ruta . $name;
            $noticia->descripcion_noticia = $request->input('descripcion_noticia');
            $noticia->fecha_inicio_noticia = $request->input('fecha_inicio_noticia');
            $noticia->fecha_fin_noticia = $request->input('fecha_fin_noticia');
            $noticia->save();
            return redirect('noticias');
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
            'titulo_noticia' => 'required|string',

            'descripcion_noticia' => 'required|string',
            'fecha_inicio_noticia' => 'required',
            'fecha_fin_noticia' => 'required'
        ]);
        if ($v) {
            if (!empty($request->imagen_noticia)) {
                list($type, $imageData) = explode(';', $request->imagen_noticia);
                list(, $extension) = explode('/', $type);
                list(, $imageData) = explode(',', $imageData);
                $name = $request->titulo_noticia.Carbon::now()->timestamp . '.' . $extension;
                $source = fopen($request->imagen_noticia, 'r');
                $destination = fopen('/home/saludmac/apiapp.saludmachala.gob.ec/img/noticia/' . $name, 'w');
                stream_copy_to_stream($source, $destination);

                fclose($source);
                fclose($destination);
                $ruta = '/img/noticia/';
            } else {
                $noticia = Noticias::where('id_noticia', $id)->first();

                $name=$noticia->imagen_noticia;
            }

            $noticia = Noticias::find($id)->firstOrFail();
            $noticia->titulo_noticia = $request->input('titulo_noticia');
            $noticia->imagen_noticia = $ruta . $name;
            $noticia->descripcion_noticia = $request->input('descripcion_noticia');
            $noticia->fecha_inicio_noticia = $request->input('fecha_inicio_noticia');
            $noticia->fecha_fin_noticia = $request->input('fecha_fin_noticia');
            DB::table('noticias')
                ->where('id_noticia', $id)
                ->update(
                    ['titulo_noticia' => $noticia->titulo_noticia, 'imagen_noticia' => $noticia->imagen_noticia, 'descripcion_noticia' => $noticia->descripcion_noticia, 'fecha_inicio_noticia' => $noticia->fecha_inicio_noticia, 'fecha_fin_noticia' => $noticia->fecha_fin_noticia]
                );
            return redirect('noticias');
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
        $noticia = Noticias::find($id);
        $noticia->delete();
        //
    }
    public function noticias()
    {
        return view('noticias');
    }
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum')->except(['index','noticias']);
    }

}
