<?php

namespace App\Livewire\Cliente\Agendamentos;

use App\Models\Agendamento;
use Livewire\Component;
use App\Models\UserCorte;
use Carbon\Carbon;

class EditarAgendamento extends Component
{
    public Agendamento $agendamento;
    public $cortes = [];
    public $date;
    public $agendamentoModal = [];  
 

    public function mount() {
        $this->cortes = $this->agendamento->cortes()->pluck('user_corte.id')->toArray();
        $this->date  =  \Carbon\Carbon::parse($this->agendamento->start_date)->format('d-m-Y H:i');
      
    }


    public function editar(Agendamento $agendamento)
    {
      
    

       
      
        
        $evento = Agendamento::findOrFail($agendamento->id);
        $this->authorize('update', $evento);

        $startDate = Carbon::parse($this->date);
        if ($startDate->isPast()) {
            session()->flash('error', 'Não é possível agendar um horário no passado.');
            $this->dispatch('mostrar');
            return;
        }
        
        $intervalInMinutesTotal = 0; 
      
        foreach ($this->cortes as $corteId) {
            $corteSelecionado = UserCorte::
            findOrFail($corteId)
            ->corte;
            $intervalInMinutesTotal += $this->convertTimeToMinutes($corteSelecionado->intervalo);
        }
    
        $end_date_clone = Carbon::parse($this->date)->clone()->addMinutes($intervalInMinutesTotal);
    
        $barbeiroSelecionado = $agendamento->colaborador;
        $eventosAgendados = $barbeiroSelecionado->agendamentos;
  
   
        foreach ($eventosAgendados as $appointment) {
            if ($this->agendamento->id && $appointment->id === $this->agendamento->id) {
                 continue;
            }
    
            $existingStartTime = Carbon::parse($appointment->start_date);
            $existingEndTime = Carbon::parse($appointment->end_date);
            
            if (Carbon::parse($this->date) < $existingEndTime && $end_date_clone > $existingStartTime) {
                session()->flash('error', 'Tente diminuir o número de cortes, pois o seu agendamento esta sobrepondo horários já agendados.');
                $this->dispatch('mostrar');
                return false;
            }
        }
        $removedDates = $barbeiroSelecionado->specificDates()
        ->where('status', 'remover')
       ->whereDate('start_date', Carbon::parse($this->date)->format('Y-m-d'))
        ->get();
   
        foreach ($removedDates as $removedDate) {
           $startHorarioRemovido = Carbon::parse($removedDate->start_date);
           $endHorarioRemovido = Carbon::parse($removedDate->end_date);
   
           if (Carbon::parse($this->date) < $endHorarioRemovido && $end_date_clone > $startHorarioRemovido) {
          
               session()->flash('error', 'Tente diminuir o número de cortes, pois o seu agendamento esta sobrepondo a horários removidos pelo barbeiro.');
               $this->dispatch('mostrar');
               return false;
           }
       }
    
       $availableTimes = $barbeiroSelecionado->getAllAvailableTimes($this->date, $agendamento);

       // Filtrar apenas os horários disponíveis sem cor atribuída
       $availableTimesWithoutColor = array_filter($availableTimes, function($availableTime) {
        return $availableTime['color'] === '' || $availableTime['color'] === 'black';
    });

       
       $selectedDateTime = Carbon::createFromFormat('d-m-Y H:i', $this->date);
       $isTimeAvailable = false;
   
       foreach ($availableTimesWithoutColor as $availableTime) {
           $availableDateTime = $availableTime['time'];
   
           // Verifica se o horário selecionado corresponde a um dos horários disponíveis
           if ($selectedDateTime->eq($availableDateTime)) {
               $isTimeAvailable = true;
               break;
           }
       }
   
       if (!$isTimeAvailable) {
           session()->flash('error', 'O horário selecionado não está disponível.');
           $this->dispatch('mostrar');
           return false;
       }
   
       if ($barbeiroSelecionado->isEndTimeExceeded($this->date, $end_date_clone)) {
           session()->flash('error', 'O horário final selecionado ultrapassa o término do expediente da barbearia.');
           $this->dispatch('mostrar');
           return false;
       }
       
   
    
    
    

        $evento->cortes()->sync($this->cortes);
        $evento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
        $evento->end_date = $end_date_clone;
        $evento->save();
    

        $this->dispatch('agendamento-editado');
   
    }

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }
   


    public function render()
    {
        return view('livewire.cliente.agendamentos.editar-agendamento');
    }
}
