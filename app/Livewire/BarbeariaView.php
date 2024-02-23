<?php

namespace App\Livewire;

use App\Enums\DaysOfWeek;
use App\Models\Barbearia;
use App\Models\Barbeiros;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Agendamento;
use Livewire\WithFileUploads;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Livewire\Auth;
use App\Models\Avaliacao;
use App\Models\Favorito;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use DateTime;

use Illuminate\Validation\Rules\Enum;

class BarbeariaView extends Component
{   
    use WithFileUploads;
    public $barbearia;
 
    public $payment;
    public $galeriaModal;
  
    public $fotos = [];
    public $descricao = [];
    #[Validate('required')]
    public $barbeiroModel;
    public $barbeiroSelecionado;
    public $model;
    public $corteSelecionado;
public $total;

 #[Validate(['cortes.*' => 'required'])]
public array $cortes = [];
#[Validate('required')]    
    public $date;

    public $dayOfWeek;
   



    public function mount($slug){
  
          $this->barbearia = Barbearia::withTrashed()->where('slug', $slug)->firstOrFail();
         
        
    }

    #[Computed]
    public function avaliacao() {
      return  auth()->user()->avaliacoes->where('barbearia_id', $this->barbearia->id)->pluck('qtd')->first();
    }





    

    public function updatedDate($value)
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
    }



  
    
#[On('transactionEmit')]
    public function AgendarHorario()
    {
    
        
        $this->validate();
       




 

    
   
    
        $agendamento = new Agendamento;
        $agendamento->user_id = auth()->user()->id;
        $agendamento->barbeiro_id = $this->barbeiroSelecionado->id;
        $agendamento->start_date = Carbon::createFromFormat('d-m-Y H:i', $this->date);
  $agendamento->payment_method = $this->payment;
    
        $existingAppointments = $this->barbeiroSelecionado->agendamentos;
    
        $intervalInMinutesTotal = 0; 
    
        foreach ($this->cortes as $corte) {
            $corteSelecionado = Cortes::findOrFail($corte);
            $intervalInMinutesTotal += $this->convertTimeToMinutes($corteSelecionado->intervalo);
        }
    
        $end_date_clone = $agendamento->start_date->clone()->addMinutes($intervalInMinutesTotal);
    
        foreach ($existingAppointments as $appointment) {
            $existingStartTime = Carbon::parse($appointment->start_date);
            $existingEndTime = Carbon::parse($appointment->end_date);
            $selectedTime = Carbon::parse($this->date);
    
            if (
                ($selectedTime >= $existingStartTime && $selectedTime < $existingEndTime) ||
                ($existingStartTime <= $selectedTime && $existingEndTime > $selectedTime)
            ) {
                return false;
            }
        }
    
        $agendamento->end_date = $end_date_clone;
        $agendamento->save();
        $agendamento->cortes()->attach($this->cortes);
        $this->dispatch('agendamento-salvo');
        $this->reset('barbeiroModel', 'date', 'cortes', 'payment');
      
       $this->redirect(Agendamentos::class, navigate: true);
  
       
    }

    private function realizarAgendamento() {
     
     

    }



  
    
    public function salvarGaleria() {
     $this->authorize('create', $this->barbearia);
        $galeriasExistente = $this->barbearia->galeria ?? [];
      
        foreach ($this->fotos as $index => $foto) {
            $caminhoImagem = $foto->store("/", "s3");
    
     
            $galeriasExistente[] = [
                "descricao" => $this->descricao[$index],
                "foto"  => $caminhoImagem,
            ];
        }
    
   
        $this->barbearia->galeria = $galeriasExistente;
    
      
        $this->barbearia->save();
    }
  

    private function convertTimeToMinutes($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
    
        return $hours * 60 + $minutes + $seconds / 60;
    }

    public function updatedBarbeiroModel($value) {
if($value) {
$this->barbeiroSelecionado = Barbeiros::findOrFail($value);

$diasDaSemana = [
    'domingo' => 0,
    'segunda' => 1,
    'terça' => 2,
    'quarta' => 3,
    'quinta' => 4,
    'sexta' => 5,
    'sábado' => 6,
];

foreach ($this->barbeiroSelecionado->workingHours as $workingHour) {
    $workingHour->dia_numero = $diasDaSemana[strtolower($workingHour->day_of_week)];
}

}

}

public function render()
{
    $response = Http::get('https://graph.instagram.com/me/media', [
        'fields' => 'id,caption,media_url',
        'access_token' => 'IGQWRQaF9QZADVpOU4zd0dPMVBoUTJXTi1NRW9BNXZAQdjh5NlFiSWY4MnhQb052XzFBOEg2YmdEU0REMkZA2ZA0QzMnI0dmNFMHU1TEROWFRTc2NuV3JETWMwZAE81TUtSYjJ6OHlOblZAfSlBsYjg4WG9aVmxmNHY2QjdGQ19OaHJPMXU5ZAwZDZD'
    ])->json();

    return view('livewire.barbearia-view', compact('response'));
}


   
    
}
