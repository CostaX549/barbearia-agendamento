<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{Validate, Computed, On};
use App\Models\Barbeiros;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Enums\DaysOfWeek;

class AgendarBarbearia extends Component
{
    public $barbearia;
    #[Validate(['cortes' => 'filled', 'cortes.*' => 'required'])]
    public array $cortes = [];
    #[Validate('required')]    
    public $date;
    public $barbeiroSelecionado;
     #[Validate('required')]
    public $barbeiroModel;
    public $payment;
    public $corteSelecionado;
    public $dayOfWeek;
    public $formattedDates = [];
    public $specificDate;


  
    #[Computed]
    public function barbeiros() {
        return $this->barbearia->barbeiros;
    }

    public function updatedBarbeiroModel($value) {

  $this->reset('date', 'cortes');
  $this->dispatch('teste');
        if($value) {
        $this->barbeiroSelecionado = Barbeiros::findOrFail($value);
        
   


        $specificDates = $this->barbeiroSelecionado->specificDates->where("status", "adicionar");

    

        foreach ($specificDates as $specificDate) {
            $this->formattedDates[\Carbon\Carbon::parse($specificDate->start_date)->format('Y-m-d')] = [
                'minTime' => \Carbon\Carbon::parse($specificDate->start_date)->format('H:i'),
                'maxTime' => \Carbon\Carbon::parse($specificDate->end_date)->format('H:i')
            ];
        }
        
        }
    }

/*     public function updatedDate($value)
    {
        $datetime = Carbon::parse($value);
    
    
    
       
        $dayTranslations = [
            'Monday' => 'Segunda',
            'Tuesday' => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday' => 'Quinta',
            'Friday' => 'Sexta',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];
    
      
        $dayOfWeek = $datetime->format('l');
    
  
        $translatedDayOfWeek = $dayTranslations[$dayOfWeek] ?? $dayOfWeek;
    
     
    
        $this->dayOfWeek = ucfirst($translatedDayOfWeek);

        $this->specificDate = $datetime;
    }
 */

 public function AgendarHorario()
 {
     $this->authorize('agendar', $this->barbearia);
     $this->authorize('authenticated', auth()->user());
  
     $this->validate();
     
     $agendamento = new Agendamento;
     $agendamento->user_id = auth()->user()->id;
     $agendamento->barbeiro_id = $this->barbeiroSelecionado->id;
     $agendamento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
 
     $intervalInMinutesTotal = 0; 
     foreach ($this->cortes as $corteId) {
         $corteSelecionado = Cortes::findOrFail($corteId);
         $intervalInMinutesTotal += $this->convertTimeToMinutes($corteSelecionado->intervalo);
     }
 
     $end_date_clone = $agendamento->start_date->clone()->addMinutes($intervalInMinutesTotal);
 


     $eventosAgendados = $this->barbeiroSelecionado->agendamentos;
   
     foreach ($eventosAgendados as $appointment) {
    
 
         $existingStartTime = Carbon::parse($appointment->start_date);
         $existingEndTime = Carbon::parse($appointment->end_date);
         
         if (Carbon::parse($this->date) < $existingEndTime && $end_date_clone > $existingStartTime) {
             session()->flash('error', 'Escolha um horário disponível, ou o horário de término do seu agendamento está se sobrepondo a horários já agendados.');
             $this->dispatch('mostrar');
             return;
         }
     }


  
     $date = Carbon::parse($this->date);
     $datasRemovidas = $this->barbeiroSelecionado->specificDates()
     ->where('status', 'remover')
     ->whereDate('start_date', '=', $date->format('Y-m-d'))
     ->get();
     foreach ($datasRemovidas as $dataEspecifica) {
         $startDate = Carbon::parse($dataEspecifica->start_date);
         $endDate = Carbon::parse($dataEspecifica->end_date);
      
   
         if ($date < $endDate && $end_date_clone > $startDate) {
             session()->flash('error', 'Escolha um horário disponível, este horário foi removido pela barbearia neste dia.');
             $this->dispatch('mostrar');
             return;
         }
     }
$startDate = Carbon::parse($this->date);

$numeroDia = $startDate->dayOfWeek; 


$nomesDiasSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
$dia = $nomesDiasSemana[$numeroDia];
$specificDates = $this->barbeiroSelecionado->specificDates
    ->where('status', 'adicionar')
    ->filter(function ($specificDate) use ($date) {
        $startDate = Carbon::parse($specificDate->start_date);
        
        return $startDate->format('Y-m-d') === $date->format('Y-m-d');
    });
$horasTrabalho = $this->barbeiroSelecionado->workingHours()->where("day_of_week", constant(DaysOfWeek::class . '::' . $dia))->first();
$totalMinutes = $this->getTotalMinutes();
if ($horasTrabalho) {
    if (!$this->verificarHorarioTrabalho($this->date, $totalMinutes, $horasTrabalho, $end_date_clone) && !$this->verificarDatasEspecificas($this->date, $totalMinutes, $specificDates, $end_date_clone)) {
        return false;
    }  
} else {
    if (!$this->verificarDatasEspecificas($this->date, $totalMinutes, $specificDates, $end_date_clone)) {
        return false;
    }
}

 
  
     $this->saveAgendamento($agendamento, $end_date_clone);

     $firebaseToken = auth()->user()->token;
     Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ya29.a0AfB_byBdzX-Bj0INODFJbfYPQOHjuV0bLUiBTebQB6g3WEkR-sfA--Gy1OQZByI_7gDt0iSfxYZnhWH_PkXhQvBJrsr6atD0HKWOzXenPAldnLe_5LV-Ur0T04xpqn3ZXkv-PfD6JM_5eR13-XvS-8-Temc16WRF4p7JaCgYKAYYSARMSFQHGX2MiPIjXVH21O-b8r_rqRPLpHg0171'
    ])->post('https://fcm.googleapis.com/v1/projects/barbearia-agendamento-7fe43/messages:send', [
        "message" => [
            "token" => $firebaseToken,
            "notification" => [
                "title" => "Agendamento criado com sucesso.",
                "body" => "Data: ". $date->format('d/m/Y H:i'),
                "image" => "http://localhost/storage/" . $agendamento->barbeiro->barbearia->imagem
            ],
            "webpush" => [
                "fcm_options" => [
                    "link" => "http://localhost/home"
                ]
            ]
        ]
    ]);

$this->redirect('/home');
   
   

 
    
 }
 

 
 private function getTotalMinutes()
 {
     $interval = $this->barbeiroSelecionado->interval;
     list($hours, $minutes, $seconds) = explode(':', $interval);
     return ($hours * 60) + $minutes;
 }
 
 private function verificarHorarioTrabalho($date, $totalMinutes, $horasTrabalho, $endDate)
 {
     $horaAbertura = Carbon::parse($horasTrabalho->start_hour); 
     $horaFechamento = Carbon::parse($horasTrabalho->end_hour); 
     $horarioSelecionado = Carbon::parse($date);

     if ($endDate->day > $horarioSelecionado->day || $endDate->format('H:i') > $horaFechamento->format('H:i')) {
        return false;
     } else {
 
     $horariosIntervalo = [];
     $horaAtual = $horaAbertura->copy();
     while ($horaAtual < $horaFechamento) {
         $horariosIntervalo[] = $horaAtual->format('H:i');
         $horaAtual->addMinutes($totalMinutes);
     }

     return in_array($horarioSelecionado->format('H:i'), $horariosIntervalo);
    }
 }
 
 private function verificarDatasEspecificas($date, $totalMinutes, $datasEspecificas, $final)
 {


   
 
     $horaSelecionada = Carbon::parse($date)->format('H:i');
     foreach ($datasEspecificas as $dataEspecifica) {

      
         $startDate = Carbon::parse($dataEspecifica->start_date);
         $endDate = Carbon::parse($dataEspecifica->end_date);
         if($final > $endDate) {
       
            session()->flash('error', 'Horário de término do agendamento é maior que o horário de fechamento da barbearia');
            $this->dispatch('mostrar');
            return;
         }
         $startDateTime = $startDate->copy();
         $horariosIntervalo = []; 
     
         while ($startDateTime < $endDate) {
             $horariosIntervalo[] = $startDateTime->format('H:i');
             $startDateTime->addMinutes($totalMinutes);
         }
   
         if (in_array($horaSelecionada, $horariosIntervalo)) {
             return true;
         }

      
     }
  
     return false;
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

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }

    public function render()
    {
        
        return view('livewire.agendar-barbearia');
    }
}
