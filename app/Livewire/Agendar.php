<?php

namespace App\Livewire;

use App\Models\Agendamento;
use Livewire\Component;
use App\Models\Barbearia;
use Carbon\Carbon;
use Livewire\Attributes\{Computed,Url};
use Livewire\WithPagination;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Illuminate\Support\Facades\Http;
 

class Agendar extends Component
{

    use WithPagination;
    
    public $barbearia;
    public $simpleModal;
    public $barbeiros;
  

    public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
     
        $this->barbeiros = $this->barbearia->barbeiros()->withTrashed()->first()->id;
          
       

      
}


#[Computed]
public function agendamentosFiltrados()
{       
    return $this->barbearia->barbeiros->where("id", $this->barbeiros)->first()?->agendamentos()->withTrashed()->paginate(10);
}


public function concluir(Agendamento $agendamento) {
    $agendamento->delete();
    
  
    $agendamento = Agendamento::withTrashed()->find($agendamento->id);

    $firebaseToken = $agendamento->owner->token;
    $pvKeyPath = public_path('pvKey.json');
    $credential = new ServiceAccountCredentials(
       "https://www.googleapis.com/auth/firebase.messaging",
       json_decode(file_get_contents($pvKeyPath), true)
   );
   
   $token = $credential->fetchAuthToken(HttpHandlerFactory::build());


   try {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer '. $token['access_token']
    ])->post('https://fcm.googleapis.com/v1/projects/barbearia-agendamento-7fe43/messages:send', [
        "message" => [
            "token" => $firebaseToken,
            "notification" => [
                "title" => "Seu agendamento para " . $agendamento->start_date->format('d/m/Y H:i') . ", foi concluído com sucesso.",
                "body" => "Concluído às: ". ($agendamento->deleted_at ? $agendamento->deleted_at->format('d/m/Y H:i') : 'Não disponível'),
                "image" => "https://barbearia-agendamento-2024.s3.sa-east-1.amazonaws.com/" . $agendamento->colaborador->barbearia->imagem
            ],
            "webpush" => [
                "fcm_options" => [
                    "link" => "http://localhost/home?tab=pills-contact8"
                ]
            ]
        ]
    ]);
    

    $response->throw();
} catch (\Exception $e) {
  dd($e->getMessage());
}
    
}

public function cancelar($id) {
    $agendamento =  Agendamento::withTrashed()->findOrFail($id);
    $agendamento->restore();
}


#[Computed]
public function agendamentos()
{
    $barbeiros = $this->barbearia->barbeiros;

    

 return  \App\Models\Agendamento::query()
        ->whereIn('barbearia_user_id', $barbeiros->pluck('id')) 
        ->when($this->option === 'Em breve', function ($query) {
            return $query
     
                        ->where('status',0);
                
              
        })
        ->when($this->option === 'Em atraso', function ($query) {
            return $query
               
                ->where('end_date', '<', Carbon::now())
                ->where('status', 0);
        })
        ->when($this->option === 'Concluída', function ($query) {
            return $query
               
                ->where('status', 1);
        })
      
        ->get();


}

public function EventoConcluido($id){
       $evento = Agendamento::findOrFail($id);

       $evento->status = 1;

       $evento->save();
       

}
    public function render()
    {
       
        return view('livewire.agendar')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
