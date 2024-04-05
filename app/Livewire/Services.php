<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barbearia;
use App\Models\Cortes;

class Services extends Component
{

    public $barbearia;
    public $corteModal;
    public $cortename;
    public $cortedescricao;
    public $currency;

    public function mount($slug)
    {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
    }

    public function criarCorte(Barbearia $barbearia) {
        $corte = new Cortes;
        $corte->nome = $this->cortename;
        $corte->descricao = $this->cortedescricao;
        $corte->preco = $this->currency;
        $corte->barbearia_id = $barbearia->id;
        $corte->save();
  $this->dispatch('corte-salvo');
   }


    public function render()
    {
        return view('livewire.services')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
