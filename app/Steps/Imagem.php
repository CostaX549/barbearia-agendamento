<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;
use App\Models\Barbearia;
use App\Models\Barbeiros;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Http;
use App\Models\BarbeiroWorkingHours;
use App\Models\Plan;

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
     * Step Validation
     */
/*     public function validate()
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
    } */


   
    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Imagem');
    }
}