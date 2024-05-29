<?php


namespace App\Livewire\Cliente\Barbearias;

use Livewire\Component;
use Livewire\Attributes\{On, Computed};
use App\Models\Avaliacao;


class Comentarios extends Component
{
    public $comment;
    public $barbearia;
    public  $responding;
    public $resposta;
    public $all = false;

   
    #[Computed]
    public function avaliacoes() {

        
        
        return $this->barbearia->avaliacoes;
    }
    #[Computed]
    public function media(){
              $total = 0;
             $qtde = $this->barbearia->avaliacoes->count();
            
             foreach($this->barbearia->avaliacoes as $ava){
                     $total+=$ava->qtd;
             }

             if ($qtde > 0) {
               
                return $total /$qtde ;
            } else {
                return 0; 
            }
    }

    public function seeAll() {
        $this->all = true;
    }

    public function voltar() {
        $this->all = false;
        $this->dispatch('recarregar');
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
        return view('livewire.cliente.barbearias.comentarios');
    }
}
