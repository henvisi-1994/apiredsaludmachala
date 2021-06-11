<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Noticias;

class NoticiaComponent extends Component
{
    use WithPagination;
    public $view='create';
    public $titulo_noticia, $imagen_noticia, $descripcion_noticia, $fecha_inicio_noticia, $fecha_fin_noticia;
    public function render()
    {
        return view('livewire.noticia-component',['noticias' => Noticias::orderBy('id_noticia','desc')->paginate(8)]);
    }
    public function store(){

        console.log("Hoolaaaaaaaaa");
        $this->validate([
            'titulo_noticia' => 'required|string',
            'imagen_noticia' => 'required|string',
            'descripcion_noticia' => 'required|string',
            'fecha_inicio_noticia' => 'required',
            'fecha_fin_noticia' => 'required'
        ]);
        Noticias::create([
            'titulo_noticia' =>$this->titulo_noticia,
            'imagen_noticia' =>$this->imagen_noticia,
            'descripcion_noticia' =>$this->descripcion_noticia,
            'fecha_inicio_noticia' =>$this->fecha_inicio_noticia,
            'fecha_fin_noticia' =>$this->fecha_fin_noticia

        ]);
    }
    public function destroy($id_noticia){ Noticias::destroy($id_noticia); }
}
