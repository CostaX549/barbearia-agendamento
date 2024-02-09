<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resposta;

class Responder extends Component
{
    public $avaliacao;
    public $resposta;

    public function responder($id) {
        $resposta = new Resposta;
        $resposta->user_id = auth()->user()->id;
        $resposta->text = $this->resposta;
        $resposta->avaliacao_id = $id;
        $resposta->save();
        $this->reset('resposta');
    }
    public function render()
    {
        return view('livewire.responder');
    }
}
