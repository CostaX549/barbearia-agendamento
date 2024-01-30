<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barbearia;
use App\Models\Barbeiros;
use App\Models\Cortes;
use Livewire\Attributes\{Validate,On};
use Livewire\WithFileUploads;

class Horarios extends Component
{
    public $barbearia;
  
    public $barbeiroModel;
    public $barbeiroSelecionado;
  

    public ?Barbeiros $editing = null; 

    use WithFileUploads;

    public function mount($slug)
    {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
    }

     
   public function edit(Barbeiros $barbeiro): void
   {
       $this->editing = $barbeiro;
    
    }

   

  /*   public function updatedBarbeiroModel($value)
    {
        if ($value) {
            $this->barbeiroSelecionado = Barbeiros::findOrFail($value);
          
    
            foreach ($this->allDaysOfWeek as $day) {
                $workingHour = $this->barbeiroSelecionado->workingHours->firstWhere('day_of_week', $day);
    
                if ($workingHour) {
                    $this->dias[$day] = true;
                    $this->horariosIniciais[$day] = $workingHour->start_hour;
                    $this->horariosFinais[$day] = $workingHour->end_hour;
                } else {
                 
                    $this->horariosIniciais[$day] = null;
                    $this->horariosFinais[$day] = null;
                }
            }
        }
        
    } */

    #[On('equipe-edit-canceled')]

    
    public function disableEditing()
    {
   $this->editing = null;
 
 
    } 

  
 

  
    

    public function render()
    {
        return view('livewire.horarios')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
