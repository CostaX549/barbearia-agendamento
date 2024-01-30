<?php

namespace App\Livewire;

use App\Models\Agendamento;
use Livewire\Component;
use App\Models\Barbeiros;
use Livewire\Attributes\{Validate,On};
use Livewire\WithFileUploads;
use App\Models\Cortes;

class BarbeiroEditing extends Component
{
    use WithFileUploads;

    public $allDaysOfWeek = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
    #[Validate(['dias.*' => 'nullable'])]
    public $dias = [];
    #[Validate(['horariosIniciais.*' => 'required_with:dias.*'], onUpdate: false)]
    public $horariosIniciais = [];

    #[Validate(['horariosFinais.*' => 'required_with:dias.*'], onUpdate: false)]
    public $horariosFinais = [];

    public $foto;
    public $interval;
    public $corteModal;
    public $cortename;
    public $cortedescricao;
    public $currency;
    public $name;
    public Barbeiros $barbeiro;
    
    
    public function mount()
    {
       
        $this->name = $this->barbeiro->name;
    
 
        foreach ($this->allDaysOfWeek as $day) {
         $workingHour = $this->barbeiro->workingHours->firstWhere('day_of_week', $day);
 
         if ($workingHour) {
             $this->dias[$day] = true;
             $this->horariosIniciais[$day] = $workingHour->start_hour;
             $this->horariosFinais[$day] = $workingHour->end_hour;
         } else {
          
             $this->horariosIniciais[$day] = null;
             $this->horariosFinais[$day] = null;
         }
        }

        $this->interval = $this->barbeiro->interval;
    }

    public function toggleCheckbox($day)
    {
     
        if (isset($this->dias[$day]) && !$this->dias[$day]) {
            unset($this->dias[$day]);
        

        }
    }


    public function editarBarbeiro(Barbeiros $barbeiro)
{

  $this->validate();

$barbeiro->name = $this->name;
$barbeiro->interval = $this->interval;

if($this->foto) {
$barbeiro->avatar = $this->foto->store('uploads', 'public');
}
$barbeiro->save();

    $selectedDays = array_keys(array_filter($this->dias, function ($value) {
        return $value === true;
    }));

   
    $existingWorkingHours = $barbeiro->workingHours;


    foreach ($existingWorkingHours as $workingHour) {
    
        if (in_array($workingHour->day_of_week, $selectedDays)) {
         
            $workingHour->update([
                'start_hour' => $this->horariosIniciais[$workingHour->day_of_week],
                'end_hour' => $this->horariosFinais[$workingHour->day_of_week],
            ]);

          
            unset($selectedDays[array_search($workingHour->day_of_week, $selectedDays)]);
        } else {
           
            $workingHour->delete();
        }
    }

   
    foreach ($selectedDays as $day) {
       
        $barbeiro->workingHours()->create([
            'day_of_week' => $day,
            'start_hour' => $this->horariosIniciais[$day],
            'end_hour' => $this->horariosFinais[$day],
        ]);
    }

   
$this->dispatch('equipe-edit-canceled');

}



    
    public function criarCorte(Barbeiros $barbeiro) {
        $corte = new Cortes;
        $corte->nome = $this->cortename;
        $corte->descricao = $this->cortedescricao;
        $corte->preco = $this->currency;
        $corte->barbeiro_id = $barbeiro->id;
        $corte->save();
  $this->dispatch('corte-salvo');
   }

    public function render()
    {
        return view('livewire.barbeiro-editing');
    }
}
