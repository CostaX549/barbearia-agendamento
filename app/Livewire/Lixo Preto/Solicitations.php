<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BarbeariaUser;

class Solicitations extends Component
{
    public function solicitations() {
        $solicitacoes = BarbeariaUser::where('user_id', auth()->user()->id)->get();
 
        return $solicitacoes;
    }
    public function render()
    {
        return view('livewire.solicitations');
    }
}
