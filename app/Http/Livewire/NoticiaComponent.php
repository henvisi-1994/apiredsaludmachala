<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Noticias;

class NoticiaComponent extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.noticia-component',['noticias' => Noticias::orderBy('id_noticia','desc')->paginate(8)]);
    }
    public function destroy($id_noticia){ Noticias::destroy($id_noticia); }
}
