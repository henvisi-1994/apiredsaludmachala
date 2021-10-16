<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HorasComponent extends Component
{
    public $view='create';

    public function render()
    {
        return view('livewire.horas-component');
    }
}
