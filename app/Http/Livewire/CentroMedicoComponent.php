<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CentroMedicoComponent extends Component
{    public $view='create';

    public function render()
    {
        return view('livewire.centro-medico-component');
    }
}
