<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\{Validate, On};
use App\Models\Barbearia;
use WireUi\Traits\Actions;
use App\Models\Barbeiros;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Plan;
use PayPal\Common\PayPalModel;
use PayPal\Api\Currency;
use PayPal\Api\ChargeModel;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use MercadoPago\Exceptions\MpApiException;
class Teste extends Component

{
   use Actions;
      use WithFileUploads;
    public $apiContext;
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
public $plan;
    public $preferencia;
    public $subscriptionModal;
    #[Validate('required|image')]
    public $imagem;
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string')]
    public string $complemento = '';

    private function createPreapprovalRequest(): array
    {
        $valor = 15;
        $frequency = 1; 
        $frequencyType = 'months'; 
    
        switch ($this->preferencia) {
            case 'mensal':
                $valor = 15;
                break;
            case 'anual':
                $valor = 180;
                $frequency = 12; // set to 12 months for annual
                break;
            case 'semestral':
                $valor = 90;
                $frequency = 6; // set to 6 months for semi-annual
                break;
        
            default:
       
                break;
        }
    
        $backUrls = [
            'success' => route('dashboard'),
            'failure' => route('home'),
        ];
    
        $user = auth()->user();
    
        $accessToken = 'TEST-4528145694266395-011813-76b485df71f80a98e8d91e4c222c02bc-1644184890';
        $createPlanUrl = 'https://api.mercadopago.com/preapproval_plan';
    
        $planData = [
            'reason' => 'Barbearia',
            'description' => 'Assinatura Mensal',
            'external_reference' => $user->id,
            'auto_recurring' => [
                'frequency' => $frequency,
                'frequency_type' => $frequencyType,
                'transaction_amount' => $valor,
                'currency_id' => 'BRL',
                'free_trial' => [
                    'frequency' => 1,
                    'frequency_type' => 'months',
                ],
            ],
            'application_fee' => 0.99,
            'payer_email' => $user->email,
            'back_url' => 'https://mercadopago.com.br',
            'payment_methods_allowed' => [
                'payment_types' => [
                    [
                        'id' => 'credit_card',
                    ],
                ],
                'payment_methods' => [
                    [
                        'id' => 'pix',
                    ],
                ],
            ],
        ];
    
        $planResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($createPlanUrl, $planData);
    
        $jsonPlanResponse = $planResponse->json();
    
        return $jsonPlanResponse;
    }
    
 
    

  

   public function pagar(){

  
       
    
        // Retrieve information about the user (use your own function)
        $user = auth()->user();
    
       
    
        
        $jsonPlanResponse = $this->createPreapprovalRequest();
       
         $user = User::findOrFail(auth()->user()->id);
    
         
        try {
           if($user->plans()->count()==0){
            return redirect($jsonPlanResponse['init_point']);
           } else{
             return redirect('/home');
           }
            
        }
        catch (MPApiException $error) {
    
            
            return null;
        }
    
    
    
                 
   }
  

   


 

   
     #[Computed]
     #[On('barbearia-salva')]
     public function barbearias() {
        return Barbearia::latest()->get();
     }
    public function render()
    {
      
        return view('livewire.teste');
    }
}
