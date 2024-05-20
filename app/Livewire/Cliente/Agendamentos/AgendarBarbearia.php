<?php

namespace App\Livewire\Cliente\Agendamentos;

use Livewire\Component;
use Livewire\Attributes\{Validate, Computed, On};
use App\Models\Barbeiros;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Enums\DaysOfWeek;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use App\Models\BarbeariaUser;
use App\Models\UserCorte;
use App\Models\Barbearia;
use App\Models\Cliente;
use App\Models\User;

class AgendarBarbearia extends Component
{
    public  $barbearia = null;
    
    #[Validate(['cortes' => 'filled', 'cortes.*' => 'required'])]
    public array $cortes = [];
    
    #[Validate('required')]    
    public string $date = '';
    
    public ?BarbeariaUser $barbeiroSelecionado = null;
    
    #[Validate('required')]
    public ?int $barbeiroModel = null;

    public ?Cortes $corteSelecionado = null;

    public array $formattedDates = [];

    public  $cliente;

    #[Validate('required')]    
    public   $paymentMethod;



  
    #[Computed]
    public function barbeiros() {
        return $this->barbearia->barbeiros;
    }

    public function updatedBarbeiroModel($value) {

  $this->reset('date', 'cortes');
  $this->dispatch('teste');
        if($value) {
        $this->barbeiroSelecionado = BarbeariaUser::findOrFail($value);
        
   


        $specificDates = $this->barbeiroSelecionado->specificDates->where("status", "adicionar");

    

        foreach ($specificDates as $specificDate) {
            $this->formattedDates[\Carbon\Carbon::parse($specificDate->start_date)->format('Y-m-d')] = [
                'minTime' => \Carbon\Carbon::parse($specificDate->start_date)->format('H:i'),
                'maxTime' => \Carbon\Carbon::parse($specificDate->end_date)->format('H:i')
            ];
        }
        
        }
    }


 public function AgendarHorario()
 {

     $this->authorize('agendar', $this->barbearia);
     $this->authorize('authenticated', auth()->user());
  
     $this->validate();
     $existingAgendamentoBarbearia = Agendamento
 
     ::where('barbearia_user_id',$this->barbeiroSelecionado->id)
     ->where('start_date', Carbon::createFromFormat('d-m-Y H:i', $this->date))
     ->first();
   

 if ($existingAgendamentoBarbearia) {
     session()->flash('error', 'Já existe um agendamento para este horário.');
     $this->dispatch('mostrar');
     return false;
 }

 
     
     $agendamento = new Agendamento;

     if($this->cliente && !$this->cliente->user_id) {
       $agendamento->cliente_id = $this->cliente->id;
     } elseif($this->cliente?->user_id) {
        $agendamento->owner_id = $this->cliente?->user_id;
     } else {
        $agendamento->owner_id = auth()->user()->id;
     }
 
     $agendamento->barbearia_user_id = $this->barbeiroSelecionado->id;
     
     $agendamento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
     $agendamento->payment_method = $this->paymentMethod;
     $agendamento->maquininha_id = $this->barbeiroSelecionado->maquininhas->first()->id;
     $intervalInMinutesTotal = 0; 
     foreach ($this->cortes as $corteId) {
         $this->corteSelecionado = UserCorte::findOrFail($corteId)->corte;
         $intervalInMinutesTotal += $this->convertTimeToMinutes($this->corteSelecionado->intervalo);
     }


 
     $end_date_clone = $agendamento->start_date->clone()->addMinutes($intervalInMinutesTotal);
 


     $eventosAgendados = $this->barbeiroSelecionado->agendamentos;
  
   
     foreach ($eventosAgendados as $appointment) {
    
 
         $existingStartTime = Carbon::parse($appointment->start_date);
         $existingEndTime = Carbon::parse($appointment->end_date);
         
         if (Carbon::parse($this->date) < $existingEndTime && $end_date_clone > $existingStartTime) {
             session()->flash('error', 'Tente diminuir o número de cortes, pois o seu agendamento esta sobrepondo horários já agendados.');
             $this->dispatch('mostrar');
             return false;
         }
     }
     $removedDates = $this->barbeiroSelecionado->specificDates()
     ->where('status', 'remover')
    ->whereDate('start_date', Carbon::parse($this->date)->format('Y-m-d'))
     ->get();

     foreach ($removedDates as $removedDate) {
        $startHorarioRemovido = Carbon::parse($removedDate->start_date);
        $endHorarioRemovido = Carbon::parse($removedDate->end_date);

        if (Carbon::parse($this->date) < $endHorarioRemovido && $end_date_clone > $startHorarioRemovido) {
       
            session()->flash('error', 'Tente diminuir o número de cortes, pois o seu agendamento esta sobrepondo a horários removidos pelo barbeiro.');
            $this->dispatch('mostrar');
            return false;
        }
    }
 
    $availableTimes = $this->barbeiroSelecionado->getAllAvailableTimes($this->date);

    // Filtrar apenas os horários disponíveis sem cor atribuída
    $availableTimesWithoutColor = array_filter($availableTimes, function($availableTime) {
        return $availableTime['color'] === '';
    });

    
    $selectedDateTime = Carbon::createFromFormat('d-m-Y H:i', $this->date);
    $isTimeAvailable = false;

    foreach ($availableTimesWithoutColor as $availableTime) {
        $availableDateTime = $availableTime['time'];

        // Verifica se o horário selecionado corresponde a um dos horários disponíveis
        if ($selectedDateTime->eq($availableDateTime)) {
            $isTimeAvailable = true;
            break;
        }
    }

    if (!$isTimeAvailable) {
        session()->flash('error', 'O horário selecionado não está disponível.');
        $this->dispatch('mostrar');
        return false;
    }

    if ($this->barbeiroSelecionado->isEndTimeExceeded($this->date, $end_date_clone)) {
        session()->flash('error', 'O horário final selecionado ultrapassa o término do expediente da barbearia.');
        $this->dispatch('mostrar');
        return false;
    }

  

 
  
     $this->saveAgendamento($agendamento, $end_date_clone);
     if(!$this->cliente) {
     $this->redirect('/home?tab=pills-contact8');
     } else {
      
        $this->barbeiroModel = null;
        $this->dispatch('refrigerar');
        $this->dispatch('cancelarEditmode');
     }
   
     if($this->cliente?->user_id) {
        $firebaseToken = $this->cliente->user->token;
     } elseif($agendamento->owner_id) {
        $firebaseToken = auth()->user()->token;  
     }
   
  
        $pvKeyPath = public_path('pvKey.json');
        $credential = new ServiceAccountCredentials(
           "https://www.googleapis.com/auth/firebase.messaging",
           json_decode(file_get_contents($pvKeyPath), true)
       );
       
       $token = $credential->fetchAuthToken(HttpHandlerFactory::build());
   
   try {
         Http::withHeaders([
           'Content-Type' => 'application/json',
           'Authorization' => 'Bearer '. $token['access_token']
       ])->post('https://fcm.googleapis.com/v1/projects/barbearia-agendamento-7fe43/messages:send', [
           "message" => [
               "token" => $firebaseToken,
               "notification" => [
                   "title" => "Agendamento criado com sucesso.",
                   "body" => "Data: ". $agendamento->start_date->format('d/m/Y H:i'),
                   "image" => "https://barbearia-agendamento-2024.s3.sa-east-1.amazonaws.com/" . $this->barbeiroSelecionado->barbearia->imagem
               ],
               "webpush" => [
                   "fcm_options" => [
                       "link" => "http://localhost/home?tab=pills-contact8"
                   ]
               ]
           ]
       ]);
    } catch(\Exception $e) {
        dd($e);
    }
   
 
   

   
   

 
    
 }
 
 #[Computed]
 public function clienteComPromocao(){
             $cliente = $this->barbearia->promocoes->clientes->where("user_id", auth()->user()->id);


             return  $cliente;
            
 }


 #[Computed]
 public function usuarioComPromocao(){
             $cliente = $this->barbearia->promocoes->users->where("id", auth()->user()->id);


             return  $cliente;
            
 }


 #[Computed]
 public function  CortesComRule(){
             $corteComPromocao = $this->barbearia->corte->promocoes->whereNotNull("rule");


             return  $corteComPromocao;
            
 }




 


 private function saveAgendamento($agendamento, $end_date_clone)
 {
    $total = 0;
    foreach($this->cortes as $corte) {
      $corteSelecionado = UserCorte::findOrFail($corte)->corte;
      $total += $corteSelecionado->preco;

    }
    $agendamento->total_price = $total;
     $agendamento->end_date = $end_date_clone;
     $agendamento->save();
  
     $agendamento->cortes()->attach($this->cortes);
     /*       $total = 0;
       foreach($this->cortes as $corte){
                  
                   foreach($corte->promocoes as $promocao){
                          if($promocao &&  $this->clienteComPromocao() || $this->usuarioComPromocao() && $this->selectedPromocao ){
                                     $total+= $corte->preco * ($promocao->desconto/100*$corte->preco);
                          }
                          else{
                                     $total+= $corte->preco;
                          }
                   }
       } */

    
              
    
     $userId = auth()->id();
     $cacheKey = "agendamentos_{$userId}";
 
     // Limpar o cache para a chave específica
     Cache::forget($cacheKey);
     $this->dispatch('agendamento-salvo');
     session()->flash('status', 'Post successfully updated.');
 }

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }

    public function render()
    {
        
        return view('livewire.cliente.agendamentos.agendar-barbearia');
    }
}
