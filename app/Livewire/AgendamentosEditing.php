<?php

namespace App\Livewire;

use App\Models\Agendamento;
use Livewire\Component;

class AgendamentosEditing extends Component
{
    public Agendamento $agendamento;
    public $date;
    public function render()
    {
        return view('livewire.agendamentos-editing');
    }
}
