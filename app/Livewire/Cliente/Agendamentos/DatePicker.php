<?php

namespace App\Livewire\Cliente\Agendamentos;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Modelable;
use App\Models\Barbeiros;
use App\Models\Agendamento;
use App\Models\User;
use App\Models\BarbeariaUser;

class DatePicker extends Component
{
    #[Modelable]

    public string $date = '';

    public string $dateChanged = '';
    public ?BarbeariaUser $barbeiroSelecionado;
    public  ?Agendamento $selectedAgendamento = null;

    public  array $formattedDates = [];

    public function mount() {
        if($this->selectedAgendamento) {





            $datetime = Carbon::parse($this->date);








            $this->dateChanged = $datetime->format('d-m-Y');
        } else {
            $this->date = Carbon::now()->format('d-m-Y H:i');
            $datetime = Carbon::parse($this->date);
            $this->dateChanged = $datetime->format('d-m-Y');
        }
    }

    public function setDate($time)
    {
       $timeFormatted = Carbon::parse($time)->format('H:i');
        $this->date = Carbon::parse($this->dateChanged)->setTimeFromTimeString($timeFormatted);
    }
    public function updatedDate($value)
    {

        $datetime = Carbon::parse($value);






        $this->updateDateChanged($datetime);

    }

    public function updateDateChanged($datetime) {
        $this->dateChanged = $datetime->format('d-m-Y');
    }


    public function render()
    {
        return view('livewire.cliente.agendamentos.date-picker');
    }
}
