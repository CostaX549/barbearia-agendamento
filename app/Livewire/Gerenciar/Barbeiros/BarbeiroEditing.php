<?php

namespace App\Livewire\Gerenciar\Barbeiros;

use App\Models\Agendamento;
use Livewire\Component;
use App\Models\BarbeariaUser;
use Livewire\Attributes\{Validate,On};
use Livewire\WithFileUploads;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Enums\DaysOfWeek;
use App\Models\UserCorte;

class BarbeiroEditing extends Component
{
    use WithFileUploads;

    public $allDaysOfWeek = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
    #[Validate(['dias.*' => 'nullable'])]
    public $dias = [];
    #[Validate(['horariosIniciais.*' => 'required_with:dias.*'], onUpdate: false)]
    public $horariosIniciais = [];

    #[Validate(['horariosFinais.*' => 'required_with:dias.*'], onUpdate: false)]
    public $horariosFinais = [];
    public ?string $option = '';
public $date;
    public $foto;
    public $interval;
public array $cortes = [];
public $model;
    public $name;
    public BarbeariaUser $barbeiro;
    
    
    public function mount()
    {
       
        $this->name = $this->barbeiro->name;
        $this->option = $this->barbeiro->optionMax;

          $this->cortes = $this->barbeiro->cortes->pluck('corte.id')->toArray();
        foreach ($this->allDaysOfWeek as $index => $day) {
            $workingHour = $this->barbeiro->workingHours
            ->where('day_of_week', constant(DaysOfWeek::class . '::' . $day))
            ->first();

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


    public function editarBarbeiro(BarbeariaUser $barbeiro)
{

  $this->validate();

  if (empty(array_filter($this->dias))) {
    $this->addError('dias', 'Selecione pelo menos um dia.');
    return;
}


$barbeiro->interval = Carbon::parse($this->interval);
$barbeiro->optionMax = $this->option;
$barbeiro->save();
    $selectedDays = array_keys(array_filter($this->dias, function ($value) {
        return $value === true;
    }));

   
    $existingWorkingHours = $barbeiro->workingHours;


    foreach ($existingWorkingHours as $workingHour) {
    
        if (in_array($workingHour->day_of_week->name, $selectedDays)) {
         
            $workingHour->update([
                'start_hour' => $this->horariosIniciais[$workingHour->day_of_week->name],
                'end_hour' => $this->horariosFinais[$workingHour->day_of_week->name],
            ]);

          
            unset($selectedDays[array_search($workingHour->day_of_week->name, $selectedDays)]);
        } else {
           
            $workingHour->delete();
        }
    }



    foreach ($selectedDays as $index => $day) {


      
           $barbeiro->workingHours()->create([
               
                'day_of_week' => constant(DaysOfWeek::class . '::' . $day),
                'start_hour' => $this->horariosIniciais[$day],
                'end_hour' => $this->horariosFinais[$day],
            ]);
        
    }

  
    
       // Obter todos os cortes associados ao barbeiro
    $cortesAssociados = $barbeiro->cortesBarbearia()->pluck('corte_id')->toArray();

  
    $cortesSelecionados = $this->cortes;

    $novosCortes = array_diff($cortesSelecionados, $cortesAssociados);

    $cortesRemovidos = array_diff($cortesAssociados, $cortesSelecionados);

 
    foreach ($novosCortes as $novoCorte) {
        $userCorte = new UserCorte();
        $userCorte->barbearia_user_id = $barbeiro->id;
        $userCorte->corte_id = $novoCorte;
        $userCorte->save();
    }

    // Remover os cortes que não estão mais selecionados
    UserCorte::where('barbearia_user_id', $barbeiro->id)->whereIn('corte_id', $cortesRemovidos)->delete();

      
      
    

    
$this->dispatch('equipe-edit-canceled');

}



    
    public function criarCorte(BarbeariaUser $barbeiro) {
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
      
 


        return view('livewire.gerenciar.barbeiros.barbeiro-editing');
    }
}
