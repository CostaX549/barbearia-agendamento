<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Agendamento;
use Livewire\Attributes\{On, Computed, Lazy, Validate, Url};
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Cortes;
use App\Enums\DaysOfWeek;
#[Lazy]
class Agendamentos extends Component
{

    public ?Agendamento $editing = null;
    public $date;

  
public $agendamentoModal;
public ?Agendamento $selectedAgendamento = null;

public $cortes = [];
public $options = [];
public $barbeiroSelecionado;
public $formattedDates;



public function placeholder() {
    return view ('placeholder');
}
public function mount() {


 
}
   
   
    public function edit(Agendamento $agendamento): void
     {
        $this->editing = $agendamento;


      

    

      
      
    }

    public function delete($id) {
  

        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();
        
        $this->dispatch('refresh');
      
    }

    public function editar($id)
    {
        $this->validate([
            'cortes.' . $id => 'filled',
        ], [
            'cortes.' . $id . '.filled' => 'É necessário preencher os cortes desse agendamento.',
        ]);
        
        $evento = Agendamento::findOrFail($id);
        $this->authorize('update', $evento);
        
        $intervalInMinutesTotal = 0; 
        foreach ($this->cortes[$id] as $corteId) {
            $corteSelecionado = Cortes::findOrFail($corteId);
            $intervalInMinutesTotal += $this->convertTimeToMinutes($corteSelecionado->intervalo);
        }
    
        $end_date_clone = Carbon::parse($this->date)->clone()->addMinutes($intervalInMinutesTotal);
    
        $this->barbeiroSelecionado = $this->selectedAgendamento->barbeiro;
        $date = Carbon::parse($this->date);

        $startDate = Carbon::parse($this->date);

        $numeroDia = $startDate->dayOfWeek; 
        
        // Mapear para o nome do dia da semana
        $nomesDiasSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        $dia = $nomesDiasSemana[$numeroDia];
       $totalMinutes = $this->getTotalMinutes();

       $specificDates = $this->barbeiroSelecionado->specificDates
       ->where('status', 'adicionar')
       ->filter(function ($specificDate) use ($date) {
           $startDate = Carbon::parse($specificDate->start_date);
           
           return $startDate->format('Y-m-d') === $date->format('Y-m-d');
       });
   $horasTrabalho = $this->barbeiroSelecionado->workingHours()->where("day_of_week", constant(DaysOfWeek::class . '::' . $dia))->first();
   $totalMinutes = $this->getTotalMinutes();
   if ($horasTrabalho) {
       if (!$this->verificarHorarioTrabalho($this->date, $totalMinutes, $horasTrabalho, $end_date_clone) && !$this->verificarDatasEspecificas($this->date, $totalMinutes, $specificDates, $end_date_clone)) {
           return false;
       }  
   } else {
       if (!$this->verificarDatasEspecificas($this->date, $totalMinutes, $specificDates, $end_date_clone)) {
           return false;
       }
   }
        $eventosAgendados = $this->barbeiroSelecionado->agendamentos;
   
        foreach ($eventosAgendados as $appointment) {
            if ($appointment->id === $this->selectedAgendamento->id) {
                continue;
            }
    
            $existingStartTime = Carbon::parse($appointment->start_date);
            $existingEndTime = Carbon::parse($appointment->end_date);
            
            if (Carbon::parse($this->date) < $existingEndTime && $end_date_clone > $existingStartTime) {
                session()->flash('error', 'Escolha um horário disponível, ou o horário de término do seu agendamento está se sobrepondo a horários já agendados.');
                $this->dispatch('mostrar');
                return;
            }
        }

    
       
        $datasRemovidas = $this->barbeiroSelecionado->specificDates()
        ->where('status', 'remover')
        ->whereDate('start_date', '=', $date->format('Y-m-d'))
        ->get();

        foreach ($datasRemovidas as $dataEspecifica) {
            $startDate = Carbon::parse($dataEspecifica->start_date);
            $endDate = Carbon::parse($dataEspecifica->end_date);

       if ($date < $endDate && $end_date_clone > $startDate ) {
        session()->flash('error', 'Escolha um horário disponível, este horário foi removido pela barbearia neste dia.');
        $this->dispatch('mostrar');
        return;
    }
        }
       
   
    
    
    
        // Atualizar o agendamento
        $evento->cortes()->sync($this->cortes[$id]);
        $evento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
        $evento->end_date = $end_date_clone;
        $evento->save();
    
        $this->limparCacheAgendamentos();
        $this->dispatch('agendamento-editado');
    }

    private function verificarHorarioTrabalho($date, $totalMinutes, $horasTrabalho, $endDate)
    {
        $horaAbertura = Carbon::parse($horasTrabalho->start_hour); 
        $horaFechamento = Carbon::parse($horasTrabalho->end_hour); 
        $horarioSelecionado = Carbon::parse($date);
 
        $horariosIntervalo = [];
        

        
  
        $horaAtual = $horaAbertura->copy();
        while ($horaAtual < $horaFechamento) {
            $horariosIntervalo[] = $horaAtual->format('H:i');
            $horaAtual->addMinutes($totalMinutes);
        }


        if (!in_array($horarioSelecionado->format('H:i'), $horariosIntervalo)) {
     
       
            return false;
        }
    
        if ($endDate->day > $horarioSelecionado->day || $endDate->format('H:i') > $horaFechamento->format('H:i') && in_array($horarioSelecionado->format('H:i'), $horariosIntervalo)) {
       
            session()->flash('error', 'Horário de término do agendamento é maior que o horário de fechamento da barbearia');
            $this->dispatch('mostrar');
            return;
 
        }
    
  
        return true;
    }

    private function getTotalMinutes()
    {
        $interval = $this->barbeiroSelecionado->interval;
        list($hours, $minutes, $seconds) = explode(':', $interval);
        return ($hours * 60) + $minutes;
    }
    private function verificarDatasEspecificas($date, $totalMinutes, $datasEspecificas, $final)
    {
   
   
   
    
        $horaSelecionada = Carbon::parse($date)->format('H:i');
        foreach ($datasEspecificas as $dataEspecifica) {
            $startDate = Carbon::parse($dataEspecifica->start_date);
            $endDate = Carbon::parse($dataEspecifica->end_date);
            if ($final > $endDate) {
             session()->flash('error', 'Horário de término do agendamento é maior que o horário de fechamento da barbearia');
             $this->dispatch('mostrar');
             return;
            }
            
            $startDateTime = $startDate->copy();
            $horariosIntervalo = []; 
        
            while ($startDateTime < $endDate) {
                $horariosIntervalo[] = $startDateTime->format('H:i');
                $startDateTime->addMinutes($totalMinutes);
            }
      
            if (in_array($horaSelecionada, $horariosIntervalo)) {
                return true;
            }
   
         
        }
    }

    public function abrirModal($agendamentoId) {

   
        
    
        
        $this->selectedAgendamento = Agendamento::findOrFail($agendamentoId);

    
   
        $this->date = \Carbon\Carbon::parse($this->selectedAgendamento->start_date)->format('d-m-Y H:i');
    
       
            $this->cortes[$agendamentoId] = $this->selectedAgendamento->cortes->pluck("id")->toArray();
    
      
           
        $this->agendamentoModal = true;
        
         

    }
#[Computed]
    public function agendamentos() {
    
        $userId = auth()->id();
        
        // Defina uma chave única para o cache usando o ID do usuário
        $cacheKey = "agendamentos_{$userId}";
    
        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            // Lógica para obter os agendamentos do usuário
            return auth()->user()->eventos;
        });
    }
    public function limpar() {
   
        $this->selectedAgendamento = null;
 
        
    }

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }
   
#[On('agendamento-edit-canceled')]
  public function disableEditing() {
    $this->editing = null;
  }

  private function limparCacheAgendamentos()
  {
      $userId = auth()->id();
      $cacheKey = "agendamentos_{$userId}";
  
 
      Cache::forget($cacheKey);
  }
    public function render()
    {
      
        return view('livewire.agendamentos');
    }
}
