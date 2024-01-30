<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{Computed,  Url};
use App\Models\Barbearia;

class BarbeariaList extends Component
{

    public $selectedBarbearia;
    #[Url]
    public $search = '';


    public function compartilhar($barbeariaId) {
        
        $this->selectedBarbearia = Barbearia::findOrFail($barbeariaId);
    }

    #[Computed]
    public function barbeariasordenadas() {
 
        return Barbearia::where('nome', 'like', '%' . $this->search . '%')
            ->get()
            ->sortByDesc(function ($barbearia) {
                return $barbearia->barbeiros->pluck('agendamentos')->flatten()->count();
            });
    }

    public function render()
    {
        return view('livewire.barbearia-list');
    }
}
