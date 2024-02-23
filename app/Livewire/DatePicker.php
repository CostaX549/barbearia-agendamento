<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Modelable;

class DatePicker extends Component
{
    #[Modelable] 
    
    public $date;
    public $dayOfWeek;
    public $specificDate;
    public $dateChanged = null;
    public $barbeiroSelecionado;
    public $selectedAgendamento;
    
    public $formattedDates; 

    public function mount() {
        if($this->selectedAgendamento) {
            $this->barbeiroSelecionado = $this->selectedAgendamento->barbeiro;

      
    
         
            $datetime = Carbon::parse($this->date);
            $dayTranslations = [
                'Monday' => 'Segunda',
                'Tuesday' => 'Terça',
                'Wednesday' => 'Quarta',
                'Thursday' => 'Quinta',
                'Friday' => 'Sexta',
                'Saturday' => 'Sábado',
                'Sunday' => 'Domingo',
            ];
        
          
            $dayOfWeek = $datetime->format('l');
        
      
            $translatedDayOfWeek = $dayTranslations[$dayOfWeek] ?? $dayOfWeek;
            $specificDates = $this->barbeiroSelecionado->specificDates->where("status", "adicionar");
    
        
    
        
         
        
            $this->dayOfWeek = ucfirst($translatedDayOfWeek);
    
            $this->specificDate = $datetime;
            $this->dateChanged = $datetime->format('d-m-Y');
        }
    }
    public function updatedDate($value)
    {
      
        $datetime = Carbon::parse($value);
    
    
    
       
        $dayTranslations = [
            'Monday' => 'Segunda',
            'Tuesday' => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday' => 'Quinta',
            'Friday' => 'Sexta',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];
    
      
        $dayOfWeek = $datetime->format('l');
    
  
        $translatedDayOfWeek = $dayTranslations[$dayOfWeek] ?? $dayOfWeek;
    
 
        $this->specificDate = $datetime;
        $this->dayOfWeek = ucfirst($translatedDayOfWeek);
if($this->dateChanged !== $datetime->format('d-m-Y')) {
        $this->updateDateChanged($datetime);
}
    }

    public function updateDateChanged($datetime) {
        $this->dateChanged = $datetime->format('d-m-Y');
    }


    public function render()
    {
        return view('livewire.date-picker');
    }
}
