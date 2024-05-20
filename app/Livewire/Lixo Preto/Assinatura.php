<?php

namespace App\Livewire;

use Livewire\Component;
use MercadoPago\Exceptions\MpApiException;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Plan;
use Livewire\Attributes\Computed;
use Wireui\Traits\Actions;

class Assinatura extends Component
{
use Actions;

    public $isMercadoPagoButtonClicked = false;
    public $isStripeButtonClicked = false;
    public $preferencia;

    public function clickMercadoPagoButton()
    {
        $this->isMercadoPagoButtonClicked = true;
        $this->isStripeButtonClicked = false;
    }

    public function clickStripeButton()
    {
        $this->isStripeButtonClicked = true;
        $this->isMercadoPagoButtonClicked = false;
    }




    public function pagar()
    {
        $existingPlano = Plan::where('user_id', auth()->user()->id)->first();

        $accessToken = 'APP_USR-3045657775074783-011813-596cca2fb4fa464e0da2cd74abe69972-1642165427';
if($this->isStripeButtonClicked) {
    $this->redirect('subscription-checkout');
} else {

        // Retrieve information about the user (use your own function)
        $user = auth()->user();

        $jsonPlanResponse = $this->createPreapprovalRequest();

  if($existingPlano){
        $jsonPlanResponse = $this->createPreapprovalRequest();
        $planoResponse = $jsonPlanResponse['planoResponse'];
        $response = $jsonPlanResponse['response'];
        if($response['status'] === 'authorized') {
       
            $existingPlano->inscrito = 1;
            $existingPlano->save();
    
            
            $this->dispatch('assinatura-salva')->to(Teste::class);
            $this->dispatch('close-modal');
            
        }          
        else { 
             
            return redirect ($planoResponse['init_point']);
          }
              $user = User::findOrFail(auth()->user()->id);
              
      }
      else{
              return redirect( $jsonPlanResponse['init_point']);
      }
  
     
 

        try {
         

           
        } catch (MPApiException $error) {


            return null;
        }
    }
    }

  

    private function createPreapprovalRequest(): array
    {
        $accessToken = 'TEST-4528145694266395-011813-76b485df71f80a98e8d91e4c222c02bc-1644184890';
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


        $existingPlano = Plan::where('user_id', auth()->user()->id)->first();
        if($existingPlano) {
      
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->get('https://api.mercadopago.com/preapproval/' . $existingPlano->plan_id);

           

            $planoResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->put('https://api.mercadopago.com/preapproval_plan/' . $response->json()['preapproval_plan_id'], [
                'auto_recurring' => [
                    'transaction_amount' => $valor * (auth()->user()->barbearias->count() + 1)
                ]
            ]);
          
    
            $jsonPlanResponse = $planoResponse->json();

            return ['planoResponse' => $planoResponse->json(), 'response' => $response->json()];
        } else {
        $user = auth()->user();

   
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
                    [
                        'id' => 'debit_card',
                    ],
                    [
                        'id' => 'pix',
                    ],
                ],
                'payment_methods' => [
                   
                ]
            ]
        ];
   

        $planResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($createPlanUrl, $planData);

        $jsonPlanResponse = $planResponse->json();

        return $jsonPlanResponse;
        }
    }



    public function render()
    {
        $existingPlano = Plan::where('user_id', auth()->user()->id)->first();
    
        return view('livewire.assinatura', [
            'existingPlano' => $existingPlano
        ]);
    }
}
