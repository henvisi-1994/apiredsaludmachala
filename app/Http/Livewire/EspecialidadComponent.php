<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EspecialidadComponent extends Component
{
    public $view='create';
    public function render()
    {
        return view('livewire.especialidad-component');
    }
}
