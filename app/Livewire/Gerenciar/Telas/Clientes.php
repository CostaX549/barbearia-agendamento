<?php

namespace App\Livewire\Gerenciar\Telas;

use App\Models\Agendamento;
use App\Models\Barbearia;
use App\Models\Cliente;
use App\Models\UserCorte;
use Carbon\Carbon;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Clientes extends Component
{
        public $barbearia;

        public $nome;

        public $cliente;

        public $clienteSelecionado;

        public ?Cliente $editing;

    public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->first();
        $this->clienteSelecionado = $this->barbearia->clientes->first()?->id;
             
  }

  public function edit($id) {
 
    $this->dispatch('abrir-modal', $id);
  }



      
       public function adicionarCliente(){
                        $cliente = new Cliente();

                        $cliente->name = $this->nome;
                       $cliente->barbearia_id =  $this->barbearia->id;
             
                       $cliente->save();
       }

       public function delete(Cliente $cliente) {
        $cliente->delete();
       }

       #[Computed()]
  public function clientes(){
           return  $this->barbearia->clientes;
  }

       public function deletarCliente($id){
                       $cliente =  Cliente::findOrFail($id);

                       $cliente->delete();
       }


       

   


#[Computed]
#[On('refrigerar')]
public function agendamentosFiltrados()
{       
    return $this->barbearia->clientes->where("id", $this->clienteSelecionado)->first()?->agendamentos()->withTrashed()->paginate(10);
}



       private function saveAgendamento($agendamento, $end_date_clone)
 {
     $agendamento->end_date = $end_date_clone;
     $agendamento->save();
     $agendamento->cortes()->attach($this->cortes);
 
     $userId = auth()->id();
     $cacheKey = "agendamentos_{$userId}";
 
     // Limpar o cache para a chave específica
     Cache::forget($cacheKey);
     $this->dispatch('agendamento-salvo');
     session()->flash('status', 'Post successfully updated.');
 }
    public function render()
    {
        return view('livewire.gerenciar.telas.clientes')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
          
        ]);
    }




}
