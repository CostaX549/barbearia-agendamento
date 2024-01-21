<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Agendamento;
use Livewire\Attributes\{On, Computed};
use Carbon\Carbon;

class Agendamentos extends Component
{

    public ?Agendamento $editing = null;
    public $date;
public $agendamentoModal;
public ?Agendamento $selectedAgendamento = null;
public $cortes = [];
public $options = [];


public function mount() {


 
}
   
   
    public function edit(Agendamento $agendamento): void
     {
        $this->editing = $agendamento;


      

    

      
      
    }

    public function delete($id) {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();
        $this->redirect('/meus-agendamentos', navigate:true);

    }

    public function editar($id)
    {
        $evento = Agendamento::findOrFail($id);
    
        
        if(isset($this->cortes[$id]) && is_array($this->cortes[$id])) {
    
           
            $evento->cortes()->detach();
    
          
            $evento->cortes()->attach($this->cortes[$id]);
        }
    
       
        $endDateTime = Carbon::createFromFormat('d/m/Y H:i',$this->date);
    
        $intervalInMinutesTotal  = 0;
        foreach ($evento->cortes as $corte) {
            $intervalInMinutesTotal += $this->convertTimeToMinutes($corte->intervalo);
           
        }
         
        
         
        $evento->start_date = Carbon::createFromFormat('d/m/Y H:i',$this->date);
        $endDateTime = $evento->start_date->clone()->addMinutes($intervalInMinutesTotal);
        $evento->end_date = $endDateTime;
    
       
        $evento->save();
        $this->dispatch('agendamento-editado');
      
    }


    public function abrirModal($agendamentoId) {

   
        
        $this->agendamentoModal = true;

        
        $this->selectedAgendamento = Agendamento::findOrFail($agendamentoId);
   
        $this->date = \Carbon\Carbon::parse($this->selectedAgendamento->start_date)->format('d/m/Y H:i');
    
       
            $this->cortes[$agendamentoId] = $this->selectedAgendamento->cortes->pluck("id")->toArray();
    
      
   

    }

 
    public function limpar() {
        $this->selectedAgendamento = null;
    }

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }
    #[Computed]
    public function agendamentos() {
        return auth()->user()->eventos->where('status_paid', '1')->get();
    }
#[On('agendamento-edit-canceled')]
  public function disableEditing() {
    $this->editing = null;
  }


    public function render()
    {
        return view('livewire.agendamentos');
    }
}
