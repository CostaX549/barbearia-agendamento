<?php

namespace App\Livewire\Gerenciar\Telas;

use Livewire\Component;
use App\Models\Barbearia;
use App\Models\Promocao;

class Promocoes extends Component
{
    public $barbearia; 
    public $selectedCorte = [];
    public $descricao;
    public $nome;
    public $desconto;

    public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
    }

    public function criarPromocao() {
       
        $promocao = new Promocao;
        $promocao->name = $this->nome;
        $promocao->barbearia_id = $this->barbearia->id;
        $promocao->description = $this->descricao;
        $promocao->start_date = now();
        $promocao->end_date = now()->addMonth();
        $promocao->desconto = $this->desconto;
        $promocao->save();
        foreach($this->selectedCorte as $id){
          
        $promocao->cortes()->attach(intval($id));
        }

       foreach($this->barbearia->clientes as $cliente){
         $promocao->attach($cliente->id);
       }

         

    }
    public function render()
    {
        return view('livewire.gerenciar.telas.promocoes')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);;
    }
}
