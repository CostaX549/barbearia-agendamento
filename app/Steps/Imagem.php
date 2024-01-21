<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;
use App\Models\Barbearia;
use App\Models\Barbeiros;
use Carbon\Carbon;  

use App\Models\BarbeiroWorkingHours;

class Imagem extends Step
{
 
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'steps.imagem';
 

    /*
     * Initialize step fields
     */
   public function mount() {
    $this->mergeState([
        'imagem' => ''
    ]);
   }
    
    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'photograph';
    }

    /*
     * When Wizard Form has submitted
     */
    public function save($state)
    {

 
      $barbearia = new Barbearia;
      $barbearia->nome = $state['name'];
      $barbearia->cep = $state['cep'];
      $path = $state['imagem']->store('uploads', 'public');
      $barbearia->imagem =  $path;
      $barbearia->rua = $state['rua'];
      $barbearia->cidade = $state['cidade'];
      $barbearia->estado = $state['estado'];
      $barbearia->complemento = $state['complemento'];
      $barbearia->owner_id = auth()->user()->id;
      $barbearia->slug = $state['slug'];
      $barbearia->cpf = $state['cpf'];
      $barbearia->save();

      $barbeiro = new Barbeiros;
      $barbeiro->name = auth()->user()->name;
      $barbeiro->avatar = 'teste';
      $barbeiro->barbearia_id = $barbearia->id;
      $barbeiro->save();

      foreach ($state['dias'] as $index => $dia) {
   
     
        BarbeiroWorkingHours::create([
            'barbeiro_id' => $barbeiro->id,
            'day_of_week' => $dia,
            'start_hour' => $state['horariosIniciais'][$index],
            'end_hour' => $state['horariosFinais'][$index],
        ]);
    }

 

    }

    /*
     * Step Validation
     */
    public function validate()
    {
        return [
            [
                'state.imagem'     => ['nullable'],
               
            ],
            [],
            [
                'state.imagem'     => __('Imagem'),
               
            ],
        ];
    }

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Imagem');
    }
}