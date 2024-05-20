<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resposta;
use App\Models\Avaliacao;
use App\Models\Barbearia;

class Respostas extends Component
{
    public Avaliacao $avaliacao;
    public Barbearia $barbearia;
    public string $resposta = '';

    public function responder($id) {
        $resposta = new Resposta;
        $resposta->barbearia_id = $this->barbearia->id;
        $resposta->text = $this->resposta;
        $resposta->avaliacao_id = $id;
        $resposta->save();
        $this->reset('resposta');
    }


    public function cancelar() {
        $this->dispatch('resposta-canceled');
    }
    
    public function render()
    {
        return view('livewire.respostas');
    }
}
