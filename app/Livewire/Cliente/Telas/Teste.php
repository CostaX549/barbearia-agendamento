<?php

namespace App\Livewire\Cliente\Telas;

use App\Models\Agendamento;
use App\Models\Avaliacao;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\{Validate, On, Session, Url, Title};
use App\Models\Barbearia;
use App\Models\Plan;
use Instagram\FacebookLogin\FacebookLogin;
use WireUi\Traits\Actions;

 use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Illuminate\Support\Facades\Log;


use Carbon\Carbon;
class Teste extends Component

{
   use Actions;
      use WithFileUploads;
    public $apiContext;
    #[Url]
    public $search;
    public $contagem;
   #[Validate('required|string')]
    public  string $cep = '';
    #[Validate('required|string')]
    public  string $bairro = '';
    #[Validate('required|string')]
    public string $rua = '';
    #[Validate('required|string')]
    public string $estado = '';
    #[Validate('required|string')]
    public  string $cidade = '';
    #[Validate('required|string|unique:barbearias')]
    public string $slug = '';
    #[Url]

public $tab = 'pills-home7';
public $compartilharModal;
public $selectedBarbearia;
    public $preferencia;
    public $subscriptionModal;
    #[Validate('required|image')]
    public $imagem;
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string')]
    public string $complemento = '';

    public $barbearia;
    public $estrela;
    #[Computed]
    #[On('agendamento-editado')]
    public function notificationsNearEvents() {
        $user = auth()->user();

        $eventos = $user->eventos->filter(function ($evento) {

            return now()->diffInMinutes($evento->start_date) <= 60;
        });

        return $eventos;
    }
  /*   #[Computed]
    #[On('avaliacao-salva')]
     public function notificationsEvents() {

        $eventos = auth()->user()->eventos->where('start_date','>',Carbon::now());



       return  $eventos;
     }
 */
  public function selecionarTab($tab) {

    $this->tab = $tab;
  }





#[Computed]
#[On('avaliacao-salva')]
 public function notifications() {
    $barbearia = auth()->user()->eventos
    ->whereNotNull('deleted_at')
    ->pluck('colaborador.barbearia')

    ->unique();

    $eventos = auth()->user()->eventos->where('start_date','>',Carbon::now());

$barbeariasAvaliadas = \App\Models\Avaliacao::where('user_id', auth()->user()->id)
    ->pluck('barbearia_id');

   return  $barbearia->whereNotIn('id', $barbeariasAvaliadas->toArray());
 }

 public function mount()
 {
    if(session('status')) {

    $this->dispatch('agendamento');
    }
    $contagemEventos = $this->notificationsNearEvents->count();
     foreach ($this->notificationsNearEvents as $event) {
         if ($event->read === 1) {
             $contagemEventos = 0;
         }
     }



     $this->contagem = $this->notifications->count() + $contagemEventos;
 }


 public function save($token) {
    $user = User::findOrFail(auth()->user()->id);
    $user->token = $token;
    $user->save();
 }



 public function clicar() {
    $existingPlano = Plan::where('user_id', auth()->user()->id)->first();
    $existingPlano->inscrito = 0;
    $existingPlano->save();
 }

public function contar() {
    foreach($this->notificationsNearEvents as $event) {
        $event->read = 1;
        $event->save();
    }
}


#[On('avaliar')]
    public function avaliar($valor, $id){

        $existsAvaliacao = Avaliacao::where("barbearia_id",$id)->where("user_id",auth()->user()->id)->first();

        if(!$existsAvaliacao){
          $avaliacao = new Avaliacao;

          $avaliacao->qtd = $valor;
          $avaliacao->user_id = auth()->user()->id;
          $avaliacao->barbearia_id = $id;

          $avaliacao->save();
          $this->dispatch('avaliacao-salva');
        }else{
             $existsAvaliacao->qtd = $valor;

             $existsAvaliacao->save();
        }
    }



    public function compartilhar($barbeariaId) {

        $this->selectedBarbearia = Barbearia::findOrFail($barbeariaId);
    }

    public function compartilharRede() {

    }
















  #[Title("Página Principal")]
    public function render()
    {


        return view('livewire.cliente.telas.teste');
    }


}
