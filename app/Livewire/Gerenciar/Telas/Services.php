<?php

namespace App\Livewire\Gerenciar\Telas;

use Livewire\Component;
use App\Models\Barbearia;
use App\Models\Cortes;
use App\Models\UserCorte;
use App\Models\BarbeariaUser;
class Services extends Component
{

    public $barbearia;
    public $corteModal;
    public $cortename;
    public $cortedescricao;
    public $currency;

    public function mount($slug)
    {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
    }

    public function criarCorte(Barbearia $barbearia) {
        $barbeiro =BarbeariaUser::where("barbearia_id",$barbearia->id)->where("user_id",auth()->user()->id)->first();
        if($barbeiro){
        $corte = new Cortes;
        $corte->nome = $this->cortename;
        $corte->descricao = $this->cortedescricao;
        $corte->preco = $this->currency;
        $corte->barbearia_id = $barbearia->id;

        $userCorte = new UserCorte();
        $userCorte->barbearia_user_id = $barbeiro->id;
        $corte->save();
        $userCorte->corte_id = $corte->id;

     
        $userCorte->save();
        $this->dispatch('corte-salvo');
        } else {
           session()->flash("error", "Pague seu barbeiro para concluir a criação do corte");
        }



   }


    public function render()
    {
        return view('livewire.gerenciar.telas.services')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
