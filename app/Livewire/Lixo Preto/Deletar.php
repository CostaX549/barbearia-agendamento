<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barbearia;
class Deletar extends Component
{
       public $barbearia;

     public function mount($slug){
          $this->barbearia = Barbearia::where('slug',$slug)->first();  
     }
    public function render()
    {
        return view('livewire.deletar') ->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);;
    }
}
