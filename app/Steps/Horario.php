<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;

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
            'dias'                  => [],
     

         
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
       
        
        ]);
    }
    
    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'clock';
    }



 

    /*
     * Step Validation
     */
/*     public function validate()
    {
        return [
            [
                'state.dias.*' => ['required'],
                'state.horariosIniciais.*' => ['required_with:state.dias.*'],
                'state.horariosFinais.*' => ['required_with:state.dias.*']
               
            ],
            [],
            [
                'state.dias.*' => __('Dia'),
                'state.horariosIniciais.*' => __('Horários Inicial'),
                'state.horariosFinais.*' => __('Horário Final'),
              
               
            ],
        ];
    } */

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Horários');
    }
}