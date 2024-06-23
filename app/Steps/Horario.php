<?php

namespace App\Steps;

use App\Enums\DaysOfWeek;
use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules\Enum;
class Horario extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'steps.horario';

 

    /*
     * Initialize step fields
     */
    public function mount()
    {
        $this->mergeState([
            'dias'                 => [

            
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
            
            ],
     

         
            'horariosIniciais' => [  
                
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
                
        
        ],
           
         
            'horariosFinais' => [
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
                

            ],
           

            'intervaloInicial' => [
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
            ],
            'intervaloFinal' => [
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
            ],
       
        
        ]);

     
    }
    
    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'clock';
    }



 

 

    public function validate()
{
    $state = $this->livewire->state;

    $rules = [];
 
    $rules['state.dias'] = ['required', function ($attribute, $value, $fail) {
        if (!in_array(true, $value)) {
            $fail(__('Pelo menos um dia deve ser selecionado.'));
        }
    }];
     

    foreach ($state['dias'] as $index => $dia) {
         // Agora permitimos valores nulos

        if (!empty($dia)) { // Verifica se o dia está marcado
            $horarioInicialKey = "state.horariosIniciais.{$index}";
            $horarioFinalKey = "state.horariosFinais.{$index}";
            $intervaloInicialKey = "state.intervaloInicial.{$index}";
            $intervaloFinalKey = "state.intervaloFinal.{$index}";

            $rules[$horarioInicialKey] = ['required'];
            $rules[$horarioFinalKey] = ['required'];

            

            $rules[$horarioInicialKey][] = function ($attribute, $value, $fail) use ($state, $index, $horarioFinalKey) {
                $horarioFinal = $state['horariosFinais'][$index];
    if($value) {
                if ($value >= $horarioFinal) {
                    $fail(__('O horário inicial deve ser menor que o horário final.'));
                }
            }
            };
    
         
            $rules[$intervaloFinalKey] = [function ($attribute, $value, $fail) use ($state, $index, $horarioInicialKey, $intervaloFinalKey) {
                if ($value) {
                    $index = str_replace('state.intervaloFinal.', '', $attribute);
                    $horarioInicial = $state['horariosIniciais'][$index];
                    $horarioFinal = $state['horariosFinais'][$index];
                    $intervaloFinal = $value;
        
                    if ($intervaloFinal < $horarioInicial || $intervaloFinal > $horarioFinal) {
                        $fail(__('O intervalo final deve estar entre o horário inicial e o horário final.'));
                    }
                }
            }];
            $rules[$intervaloInicialKey] = [function ($attribute, $value, $fail) use ($state, $index, $intervaloInicialKey, $horarioFinalKey) {
                if ($value) {
                    $index = str_replace('state.intervaloInicial.', '', $attribute);
                    $horarioInicial = $state['horariosIniciais'][$index];
                    $horarioFinal = $state['horariosFinais'][$index];
                    $intervaloInicial = $value;
        
                    if ($intervaloInicial < $horarioInicial || $intervaloInicial > $horarioFinal) {
                        $fail(__('O intervalo inicial deve estar entre o horário inicial e o horário final.'));
                    }
                }
            }];
        }
    }


    return [$rules, [], []];
} 

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Horários');
    }
}