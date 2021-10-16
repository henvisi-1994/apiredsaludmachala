<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HorarioComponent extends Component
{
    public $view='create';

    public function render()
    {
        return view('livewire.horario-component');
    }
}
