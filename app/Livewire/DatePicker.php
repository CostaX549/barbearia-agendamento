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
    public $barbeiroSelecionado;
    public $selectedAgendamento;
    
    public $formattedDates; 

    public function mount() {
        if($this->selectedAgendamento) {
            $this->barbeiroSelecionado = $this->selectedAgendamento->barbeiro;

            $diasDaSemana = [
                'domingo' => 0,
                'segunda' => 1,
                'terça' => 2,
                'quarta' => 3,
                'quinta' => 4,
                'sexta' => 5,
                'sábado' => 6,
            ];
            
            foreach ($this->barbeiroSelecionado->workingHours as $workingHour) {
                $workingHour->dia_numero = $diasDaSemana[strtolower($workingHour->day_of_week)];
            }
    
    
    
            $specificDates = $this->barbeiroSelecionado->specificDates->where("status", "adicionar");
    
        
    
            foreach ($specificDates as $specificDate) {
                $this->formattedDates[\Carbon\Carbon::parse($specificDate->start_date)->format('Y-m-d')] = [
                    'minTime' => \Carbon\Carbon::parse($specificDate->start_date)->format('H:i'),
                    'maxTime' => \Carbon\Carbon::parse($specificDate->end_date)->format('H:i')
                ];
            }
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
        
         
        
            $this->dayOfWeek = ucfirst($translatedDayOfWeek);
    
            $this->specificDate = $datetime;
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
    
     
    
        $this->dayOfWeek = ucfirst($translatedDayOfWeek);

        $this->specificDate = $datetime;
    }


    public function render()
    {
        return view('livewire.date-picker');
    }
}
