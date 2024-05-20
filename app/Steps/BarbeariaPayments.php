<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;


class  BarbeariaPayments extends Step{


    
    protected string $view = 'steps.payments';

   

    public function mount() {
        $this->mergeState([
            'payments' => [],
             'maquininhaname'=> '',
             'maquininhadebito' => 0,
             'maquininhacredito' => 0
           
             ]);
       }

      
       
        
       

       public function validate()
       {

        return [
        [
            'state.payments.required' => 'O método de pagamento é obrigatório.',
            'state.payments.string' => 'O método de pagamento deve ser uma string.',
            'state.maquina.required' => 'O nome da máquina é obrigatório.',
            'state.maquina.string' => 'O nome da máquina deve ser uma string.',
            
        ]
        ];
        
       }
    public function title(): string
    {
        return __('BarbeariaPayments');
    }
}