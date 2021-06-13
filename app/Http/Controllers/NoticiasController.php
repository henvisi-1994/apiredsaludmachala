<?php

namespace App\Http\Controllers;
use App\Models\Noticias;
use Illuminate\Http\Request;


class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticia = Noticias::all();
        return response()->json($noticia ,200);
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
        $v =$this->validate(request(), [
            'titulo_noticia' => 'required|string',
            'imagen_noticia' => 'required|string',
            'descripcion_noticia' => 'required|string',
            'fecha_inicio_noticia' => 'required',
            'fecha_fin_noticia' => 'required'
        ]);
        if ($v)
        {
          $noticia= new Noticias();
          $noticia->titulo_noticia=$request->input('titulo_noticia');
          $noticia->imagen_noticia=$request->input('imagen_noticia');
          $noticia->descripcion_noticia=$request->input('descripcion_noticia');
          $noticia->fecha_inicio_noticia=$request->input('fecha_inicio_noticia');
          $noticia->fecha_fin_noticia=$request->input('fecha_fin_noticia');
          $noticia->save();
          return redirect('noticias');
        }
        else
        {
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

        $v =$this->validate(request(), [
            'titulo_noticia' => 'required|string',
            'imagen_noticia' => 'required|string',
            'descripcion_noticia' => 'required|string',
            'fecha_inicio_noticia' => 'required',
            'fecha_fin_noticia' => 'required'
        ]);
        if ($v)
        {
          $noticia = Noticias::find($id)->firstOrFail();
          $noticia->titulo_noticia=$request->input('titulo_noticia');
          $noticia->imagen_noticia=$request->input('imagen_noticia');
          $noticia->descripcion_noticia=$request->input('descripcion_noticia');
          $noticia->fecha_inicio_noticia=$request->input('fecha_inicio_noticia');
          $noticia->fecha_fin_noticia=$request->input('fecha_fin_noticia');
          $noticia->save();
          return redirect('noticias');
        }
        else
        {
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
    public function noticias(){
        return view('noticias');
    }
}

