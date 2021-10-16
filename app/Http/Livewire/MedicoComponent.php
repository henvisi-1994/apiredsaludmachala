<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MedicoComponent extends Component
{
    public $view='create';
    public function render()
    {
        return view('livewire.medico-component');
    }
}
