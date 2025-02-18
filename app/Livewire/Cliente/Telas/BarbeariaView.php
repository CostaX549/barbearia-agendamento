<?php

namespace App\Livewire\Cliente\Telas;

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
use App\Livewire\Cliente\Agendamentos\Agendamentos;
use DateTime;

use Illuminate\Validation\Rules\Enum;

class BarbeariaView extends Component
{   
    use WithFileUploads;
    public $barbearia;
 
    public $payment;
    public $galeriaModal;
  public array $redesocial = [];
  public $link;
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
    public $cardModal;

    public $dayOfWeek;
   



    public function mount($slug){
        for ($i = 0; $i < 4; $i++) {
            $this->link[$i] = '';
        }
          $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
         
        
    }






    public function save()
{
    // Verificar se a barbearia já tem redes sociais associadas
    $redeSociais = $this->barbearia->redes_sociais ?? [];

    // Verificar se há redes sociais selecionadas e links correspondentes
    if (!empty($this->redesocial) && !empty($this->link)) {
        // Loop pelas redes sociais selecionadas
        foreach ($this->redesocial as $index => $rede) {
            // Verificar se há um link correspondente
            if (isset($this->link[$index])) {
                $link = $this->link[$index];
                // Adicionar a rede social e o link ao array de redeSociais
                $redeSociais[$rede] = $link;
            }
        }
    }
    

    $this->barbearia->redes_sociais = $redeSociais;
    $this->barbearia->save();

    // Fechar o modal após salvar
    $this->cardModal = false;
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
     public function importarGaleria() {
        $url = 'https://api.instagram.com/oauth/authorize';
        
        $parameters = [
            'client_id' => '1059008688493787',
            'redirect_uri' => 'https://localhost/instagram',
            'scope' => 'user_profile,user_media',
            'response_type' => 'code',
            'state' => $this->barbearia->id
        ];
    
        $fullUrl = $url . '?' . http_build_query($parameters);
    
        return redirect($fullUrl);
    }
 

    #[Computed]
    public function galeria()
    {
     
        $barbeariaGallery = $this->barbearia->galeria ?? [];

    
     
  




           

          

        
            $combinedGallery = array_merge($barbeariaGallery);
        
          

        


      
        return $combinedGallery;
    }
    
    public function salvarGaleria() {
     $this->authorize('create', $this->barbearia);
        $galeriasExistente = $this->barbearia->galeria ?? [];
      
        foreach ($this->fotos as $index => $foto) {
            $caminhoImagem = $foto->store("/", "public");
    
     
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

   

public function render()
{

    return view('livewire.cliente.telas.barbearia-view')->title($this->barbearia->nome);
}


   
    
}
