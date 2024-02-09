<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{On, Computed};
use App\Models\Avaliacao;
use App\Models\Resposta;

class Comentarios extends Component
{
    public $comment;
    public $barbearia;
    public $resposta;
    #[Computed]
    public function avaliacoes() {

        
        
        return $this->barbearia->avaliacoes;
    }

    #[On('avaliar')]
    public function avaliar($valor, $id){

          $existsAvaliacao = Avaliacao::where("barbearia_id",$id)->where("user_id",auth()->user()->id)->first();

        if(!$existsAvaliacao){
          $avaliacao = new Avaliacao;
          
          $avaliacao->qtd = $valor;
          $avaliacao->user_id = auth()->user()->id;
          $avaliacao->barbearia_id = $id;
          $avaliacao->comment = $this->comment; 
                    
           
          $avaliacao->save();
          $this->dispatch('avaliacao-salva');
        }else{
             $existsAvaliacao->qtd = $valor;
             $existsAvaliacao->comment = $this->comment; 
             $existsAvaliacao->save();
        }
    }



    public function render()
    {
        return view('livewire.comentarios');
    }
}
