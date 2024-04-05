<?php

namespace App\Livewire;

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
        }
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
        return view('livewire.date-picker');
    }
}
