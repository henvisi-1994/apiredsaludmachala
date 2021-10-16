<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CitasComponent extends Component
{
    public $view='create';
    public function render()
    {
        return view('livewire.citas-component');
    }
}
