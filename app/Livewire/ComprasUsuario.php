<?php

namespace App\Livewire;

use App\Models\Barbearia;
use App\Models\Cliente;
use Livewire\Component;
use App\Models\Compras;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Faturas;
use Livewire\Attributes\{Validate, Computed, On};
class ComprasUsuario extends Component
{    
   
     public $barbearia;
     public $produtos = [];
     public  $quantidade = [];
      public $estoques = [];
      public $valor;
         public $comprarModal;
         public  $cliente;
         public $produtosJulio = [];
         public $clienteId;
     public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
         
       
          
       

      
}

#[Computed()] 

public function compras() {
    return Compras::where("barbearia_id", $this->barbearia->id)->get();
}
    public function render()
    {
        return view('livewire.compras-usuario', ['barbearia'=>$this->barbearia])->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);


    }
 

    public function realizarCompra(){
            
    
           
      if (!$this->cliente) {
        return session()->flash("clienteError", "Impossível atualizar o produto. A quantidade em estoque excede a quantidade máxima permitida.");
      }

      $compra = new Compras();

      foreach ($this->produtos as $index => $id) {
        
        $quantidade = intval($this->quantidade[$index]);
 
          $produto = Produto::find($id);
          if (!$produto) {
              return session()->flash("productError","Produto não encontrado.");
          }

          $estoque = $produto->estoque;
          if (!$estoque) {
            return session()->flash("estoqueError","Produto não encontrado.");
          }

          if ($estoque->quantidade_minima > $estoque->capacidade) {
              return session()->flash("estoqueError","Impossível retirar do estoque, quantidade mínima maior que a quantidade atual para o produto " . $produto->nome);
          }

          $produto->quantidade = $produto->quantidade - $quantidade;
      
          if ($produto->quantidade < $produto->quantidade_minima) {
            return session()->flash("productError","Impossível retirar do produto, quantidade mínima maior que a quantidade atual para o produto " . $produto->nome);
        }
          $this->produtosJulio[] = $produto;
           
          $estoque->capacidade -= $quantidade;
          $this->estoques[] = $estoque;

          $this->valor += $produto->quantidade * $produto->valor;

          
        
 
      }
     
      foreach($this->produtosJulio as $produto) {
        $produto->save();
      }

    

      // Verifica se algum erro ocorreu durante as verificações
      if (session()->has('flash_notification.message')) {
          return; // Sai do método sem salvar a compra se houver erros
      }

      foreach ($this->estoques as $estoque) {
          $estoque->save();
      }

        

      $compra->valor = $this->valor;
      $compra->cliente_id = $this->cliente;
      $compra->barbearia_id = $this->barbearia->id;
      $compra->save();
      foreach ($this->produtos as $index => $id) {
      $compra->produtos()->attach($id, ['quantidade' => $quantidade]);
      }
      return session()->flash("sucess","Compra realizada com sucesso.");
    }


  
    


}
