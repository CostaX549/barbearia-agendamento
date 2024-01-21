<?php

namespace App\Livewire;

use App\Models\Agendamento;
use Livewire\Component;
use App\Models\Barbearia;
use Carbon\Carbon;
use Livewire\Attributes\{Computed,Url};
 

class Agendar extends Component
{
    public $barbearia;
    public $simpleModal;
    #[Url(keep:true)]
    public $option = "Em breve";
    public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();

        foreach($this->barbearia->barbeiros as $barbeiro) {
            foreach($barbeiro->agendamentos as $agendamento) {
                $this->simpleModal[$agendamento->id] = null;
            }
        }
}

#[Computed]
public function agendamentos()
{
    $barbeiros = $this->barbearia->barbeiros;

 return  \App\Models\Agendamento::query()
        ->whereIn('barbeiro_id', $barbeiros->pluck('id')) 
        ->when($this->option === 'Em breve', function ($query) {
            return $query
     
                        ->where('status',0);
                
              
        })
        ->when($this->option === 'Em atraso', function ($query) {
            return $query
               
                ->where('end_date', '<', Carbon::now())
                ->where('status', 0);
        })
        ->when($this->option === 'Concluída', function ($query) {
            return $query
               
                ->where('status', 1);
        })
      
        ->get();


}

public function EventoConcluido($id){
       $evento = Agendamento::findOrFail($id);

       $evento->status = 1;

       $evento->save();


}
    public function render()
    {
        
        return view('livewire.agendar')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);;
    }
}
