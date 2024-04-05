<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{Computed, On, Url, Session};
use App\Models\Barbearia;
use App\Models\Favorito;
class BarbeariaList extends Component
{

    public $selectedBarbearia;
    public $favoritoExistente;
    #[Url]
    public $search = '';


    public function compartilhar($barbeariaId) {
        
        $this->selectedBarbearia = Barbearia::findOrFail($barbeariaId);
    }

   
    #[Computed]
    public function barbeariasordenadas() {
 
        return Barbearia::where('nome', 'like', '%' . $this->search . '%')
       
            ->get();
           
    }

    public function render()
    {
        return view('livewire.barbearia-list');
    }
}
