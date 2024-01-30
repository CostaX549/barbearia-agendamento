<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barbearia;

class Compartilhar extends Component
{
    public $selectedBarbearia;
    public $barbearia;

    public function compartilhar($barbeariaId) {
        
        $this->selectedBarbearia = Barbearia::findOrFail($barbeariaId);
    }
    public function render()
    {
        return view('livewire.compartilhar');
    }
}
