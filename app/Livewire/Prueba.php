<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Prueba extends Component
{
    #[Layout('components.layouts.register')]
    public function render()
    {
        return view('livewire.prueba');
    }
}
