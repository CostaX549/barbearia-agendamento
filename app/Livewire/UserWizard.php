<?php

namespace App\Livewire;

use App\Models\Barbearia;
use App\Steps\General;
use Vildanbina\LivewireWizard\WizardComponent;
use App\Models\User;
use App\Steps\Horario;
use App\Steps\Imagem;
use Livewire\WithFileUploads;



class UserWizard extends WizardComponent
{
 
    use WithFileUploads;
     // My custom class property
     public $userId;
  

     public array $steps = [
        General::class,
     
   
        Horario::class,
        Imagem::class,
  
 
    ];


     /*
      * Will return App\Models\User instance or will create empty User (based on $userId parameter) 
      */
     public function model()
     {
         return User::findOrNew($this->userId);
     }
}
