<?php

namespace App\Livewire\Cliente\Agendamentos;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Modelable;
use App\Models\Barbeiros;
use App\Models\Agendamento;
use App\Models\User;
use App\Models\BarbeariaUser;
use Livewire\Attributes\Validate;

class DatePicker extends Component
{
    #[Modelable]

    public string $date = '';

    public string $dateChanged = '';



    public $selectedTime = '';
    public ?BarbeariaUser $barbeiroSelecionado;
    public  ?Agendamento $selectedAgendamento = null;

    public  array $formattedDates = [];

    public function mount() {
        if($this->selectedAgendamento) {





            $datetime = Carbon::parse($this->date);








            $this->dateChanged = $datetime->format('d-m-Y');
        } else {
            $this->date = Carbon::now()->format('d-m-Y');
            $datetime = Carbon::parse($this->date);
            $this->dateChanged = $datetime->format('d-m-Y');
        }
    }

    public function setDate($time)
    {
        $this->selectedTime = $time;
        $datetime = Carbon::parse($this->date); // Parse existing date string
        $datetime->setTimeFromTimeString($time); // Update time part
        $this->date = $datetime->format('d-m-Y H:i'); // Format updated datetime
    }

    public function updatedDate($value)
    {

        $datetime = Carbon::parse($value);
         $this->selectedTime = "";





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
