<?php

namespace App\Livewire\Cliente\Barbearias;

use Livewire\Component;
use Livewire\Attributes\{Computed, On};
use App\Models\Favorito;

class Like extends Component
{
    public $barbearia;


    #[Computed]

    public function user() {
        return auth()->user();
    }
 
   

    public function like() {
      
        
       
        $favoritoExistente = $this->user->favoritos->where('barbearia_id', $this->barbearia->id)->first();
                                      
                                 
        

        if ($favoritoExistente) {
            $favoritoExistente->delete();
         
        }
        else {
      
           Favorito::create([
                'barbearia_id' => $this->barbearia->id,
                'user_id' => $this->user->id
            ]);
    
        }
        

    }

    public function render()
    { 
       

        return view('livewire.cliente.barbearias.like');
    }
}
