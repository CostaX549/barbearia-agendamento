<?php

namespace App\Livewire;

use App\Models\Barbearia;
use App\Models\Produto;
use Livewire\Component;
use App\Models\Estoque;
use Livewire\Attributes\{Validate, Computed, On};
use Livewire\WithFileUploads;
class EstoqueProduto extends Component
{      
      use WithFileUploads;
       public $estoque;
      #[Validate('required')]   
       public $nome;
       #[Validate('required')]   
       public $preco;
       #[Validate('required')]   
       public $codigo;
       #[Validate('required')] 
       public $quantidade;
       #[Validate('required')] 
       public $categoria;
        public $validade;
       public  $dimensao;
       public $capacidade;
       public $estoqueModel;
       public $imagem;
       public $produto;
       public $descricao;
       public $quantidade_minima;
       public $quantidade_maxima;
       #[Validate('required')] 
       public $data_validade;
       public $barbearia;
       public $estoqueModal;
       public $produtoModal;
       public $adicionarMetodos;
        public $estoqueId;
        public $editarModal;
        public $produtoSelecionado;
      
       public function mount($slug) {
       

        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
        $this->estoqueModel = $this->barbearia->estoques->first()->id;
     
          
    

      
}

#[Computed]
public function estoques() {
    return $this->barbearia->estoques;
}

 public function selecionarProduto($id){

                $this->editarModal = true;
                $this->produtoSelecionado = Produto::where("id", $id)->first();
               
 }
#[Computed]
public function produtos() {
    
    return Produto::where("estoque_id", $this->estoqueModel)->get();

}



    public function render()
    {
        return view('livewire.estoque-produto', [ "estoque" =>$this->estoque ])->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }

   public function criarEstoque(){
    $estoque = new Estoque();
    $estoque->nome = $this->nome;
    $estoque->capacidade = $this->capacidade;
    $estoque->quantidade_minima = $this->quantidade_minima;
    $estoque->quantidade_maxima = $this->quantidade_maxima;
    $estoque->barbearia_id = $this->barbearia->id;
    $estoque->save();
   }
   public function updatedCodigo($value)
   {
       
       if (!empty($value)) {
       
           $this->produto = Produto::where('codigo', $value)->first();
       }
      
   }
  
    public function AdicionarAoEstoque(){
        $estoque = Estoque::where("barbearia_id", $this->barbearia->id)->first();

         
    
        $this->produto = Produto::where('codigo', $this->codigo)->first();
                
        if (!$this->produto) {
            $produto = new Produto();
            $produto->preco = $this->preco;
            $produto->nome = $this->nome;
            $produto->quantidade = $this->quantidade;
            $produto->imagem = $this->imagem->store('/','s3');
            $produto->dimensao = $this->dimensao;
            $produto->codigo = $this->codigo;
            $produto->descricao = $this->descricao;
            $produto->quantidade_minima =  $this->quantidade_minima;
            $produto->validade = $this->validade;
            $produto->categoria = $this->categoria;
            $produto->estoque_id = $this->estoqueModel;
             $estoque->quantidade+=$this->quantidade;
            $produto->save();
        } else {
           
            $this->produto->quantidade += $this->quantidade;
             $estoque->quantidade+=$this->quantidade;
            $this->produto->save();
        }
    
       
     
          

    }

    public function deletarEstoque(Estoque $estoque) {
        $estoque->delete();
    }

    public function deletarProduto(Produto $produto) {
        $produto->delete();
    }

  


 
    public function atualizarEstoque() {
        $estoque = Estoque::where("id", $this->estoqueModel)->first();
               
        if (!$this->produtoSelecionado || !$estoque) {
          
            return false; 
        }
    
     
        $this->produtoSelecionado->quantidade = $this->quantidade;
    
        $diferenca = abs($this->produtoSelecionado->quantidade - $this->quantidade);
    
      
        if ($this->quantidade < $this->produtoSelecionado->quantidade) {
           
            $estoque->capacidade -= $diferenca;
        } else {
         
            $estoque->capacidade += $diferenca;
        }
    
   
        if ($estoque->capacidade > $estoque->quantidade_maxima) {
            return session()->flash("estoqueError", "Impossível atualizar o produto. A quantidade em estoque excede a quantidade máxima permitida.");
        }
    
       
        if ($estoque->capacidade < $estoque->quantidade_minima) {
            return session()->flash("estoqueError", "Impossível atualizar o produto. A quantidade em estoque está abaixo da quantidade mínima permitida.");
        }
    
      
        if ($this->produtoSelecionado->quantidade < $this->produtoSelecionado->quantidade_minima) {
            return session()->flash("estoqueError", "Impossível atualizar o produto. A quantidade do produto está abaixo da quantidade mínima permitida.");
        }
    
       
        $this->produtoSelecionado->save();
        $estoque->save();
    
        return true; 
    }
    
    
   

}
