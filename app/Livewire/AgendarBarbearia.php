<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{Validate, Computed, On};
use App\Models\Barbeiros;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Models\Agendamento;

class AgendarBarbearia extends Component
{
    public $barbearia;
    #[Validate(['cortes.*' => 'required'])]
    public array $cortes = [];
    #[Validate('required')]    
    public $date;
    public $barbeiroSelecionado;
     #[Validate('required')]
    public $barbeiroModel;
    public $payment;
    public $corteSelecionado;
    public $dayOfWeek;
    public $formattedDates = [];
    public $specificDate;


  
    #[Computed]
    public function barbeiros() {
        return $this->barbearia->barbeiros;
    }

    public function updatedBarbeiroModel($value) {
        if($value) {
        $this->barbeiroSelecionado = Barbeiros::findOrFail($value);
        
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
        
        }
    }

/*     public function updatedDate($value)
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
 */

  public function AgendarHorario()
{
    $this->validate();
    
    $agendamento = new Agendamento;
    $agendamento->user_id = auth()->user()->id;
    $agendamento->barbeiro_id = $this->barbeiroSelecionado->id;
    $agendamento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
    $agendamento->payment_method = $this->payment;
    
    $intervalInMinutesTotal = 0; 
    foreach ($this->cortes as $corteId) {
        $corteSelecionado = Cortes::findOrFail($corteId);
        $intervalInMinutesTotal += $this->convertTimeToMinutes($corteSelecionado->intervalo);
    }
    
    // Cálculo do horário de término do novo agendamento
    $end_date_clone = $agendamento->start_date->clone()->addMinutes($intervalInMinutesTotal);
    
    // Verificação de sobreposição com agendamentos existentes
    $existingAppointments = $this->barbeiroSelecionado->agendamentos;
    foreach ($existingAppointments as $appointment) {
        $existingStartTime = Carbon::parse($appointment->start_date);
        $existingEndTime = Carbon::parse($appointment->end_date);
        
        // Verifica se o novo agendamento se sobrepõe com o agendamento existente
        if ($agendamento->start_date < $existingEndTime && $end_date_clone > $existingStartTime) {
            return false; // Retorna falso se houver sobreposição
        }
    }
    
    // Salva o agendamento se não houver sobreposição de horários
    $agendamento->end_date = $end_date_clone;
    $agendamento->save();
    $agendamento->cortes()->attach($this->cortes);
    $this->dispatch('agendamento-salvo');
    $this->reset('barbeiroModel', 'date', 'cortes', 'payment');
    $this->redirect(Agendamentos::class, navigate: true);
}


    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }

    public function render()
    {
        
        return view('livewire.agendar-barbearia');
    }
}
