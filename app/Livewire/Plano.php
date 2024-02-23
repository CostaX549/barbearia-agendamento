<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barbearia;
use Illuminate\Support\Facades\Http;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Client\Customer\CustomerCardClient;
use Livewire\Attributes\{On, Computed};
use App\Enums\PaymentMethods;
use Carbon\Carbon;

class Plano extends Component
{
    public $barbearia;
    public $assinatura;
    public $qrCode;
    public $plano;
    public function mount($slug)
    {    

     
        $this->barbearia = Barbearia::withTrashed()->where('slug', $slug)->firstOrFail();
           
    
          
           
   
              
          
    }



    public function cancelarAssinatura(){
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';


        
           
    
        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "cancelled"
            
        ]);
    
        $this->barbearia->delete();
      
    }
    public function pausarAssinatura(){
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';

        
           
    
     Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "paused"
            
        ]);
    
        $this->barbearia->delete();
      
    }
    public function assinarNovamente(){
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';


        
           
    
        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "authorized"
            
        ]);
    
        
      
    }

    public function assinar($formData, $paymentMethod)
    {

       
             
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433'; 


        MercadoPagoConfig::setAccessToken($accessToken);

         
       
        
        
     
        if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
        
            $this->barbearia->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
        } else {
       

            $this->barbearia->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
        }

 
        $this->barbearia->save();
        $this->barbearia->delete();
        
    
  
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {

  


    $client = new PreApprovalClient();
  

    $preapprovalData = [

        
        
        
     
   'preapproval_plan_id' => '2c9380848d698d98018d849f908c12ae',

      
        
         'payer_email'=> $formData['payer']['email'],
          
          'card_token_id' => $formData['token'],
         'auto_recurring' => [
            'frequency' => 1,
            'frequency_type' => 'months',
            'transaction_amount' => 15 ,
            'currency_id' => 'BRL',
            'free_trial' => [
                'frequency' => 1,
                'frequency_type' => 'months',
            ],
        ],

        'external_reference' => $this->barbearia->id
      
    

    ];


        

    
  $assinatura = $client->create($preapprovalData);
 
  

   
    $client_customer = new CustomerClient();

    $client = new CustomerCardClient();

 
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
    ])->get('https://api.mercadopago.com/v1/customers/search', [
        'email' => $formData['payer']['email']
    ]);
    
    if(isset($response->json()['results'][0])) {
  


    
        $responseCartaoCliente = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get("https://api.mercadopago.com/v1/customers/{$response->json()['results'][0]['id']}/cards");
    
 
    
    } else {
        $client_customer = new CustomerClient();
        $customer = $client_customer->create(["email" =>  $formData['payer']['email']]);

   
        $client = new CustomerCardClient();
        $customer_card = $client->create($customer->id, ["token" => $formData['token']]);
    
     
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get("https://api.mercadopago.com/v1/{$customer->id}/cards");

   
    }


   
    

} else {
    $preferenceID = '1660752433-7b5f0e5e-f624-4bb2-8c11-e04c162c0bf2';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->get("https://api.mercadopago.com/checkout/preferences/{$preferenceID}");
    
    
    $preco = $response->json();
   
    
    $idempotencyKey = uniqid();
    $paymentData = [
         'transaction_amount'=> $preco['items'][0]['unit_price'] ,
    
        'description' => 'Descrição do pagamento',
        'payment_method_id' => 'pix', 
        'payer' => [
            'email' => 'test_user_1498281909@testuser.com', 
        ],

        'external_reference' => $this->barbearia->id
    ];
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
        'X-Idempotency-Key' => $idempotencyKey,
    ])->post("https://api.mercadopago.com/v1/payments?access_token={$accessToken}&preference_id={$preferenceID}", $paymentData);
       
      
    $assinatura = $response->json();
   
    $this->barbearia->payment_id = $response->json()['id'];
    $this->barbearia->plan_ends_at = Carbon::parse($response->json()['date_of_expiration']);
   $this->barbearia->save();

    
}
    

    
 

   



    

      
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {
    $this->barbearia->plan_id = $assinatura->id;
  
  $this->barbearia->plan_ends_at = Carbon::parse($assinatura->next_payment_date);
  $this->barbearia->card_id = $responseCartaoCliente[0]['id'];
  $this->barbearia->save();
  
} 


   





 
      
   

    }   





    #[On('render')]
    public function render()
    {
      
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';

        if($this->barbearia->payment_id) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get("https://api.mercadopago.com/v1/payments/{$this->barbearia->payment_id}");

            $this->assinatura = $response->json();
             
        } else {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get("https://api.mercadopago.com/preapproval/{$this->barbearia->plan_id}");
           
       
        $this->assinatura = $response->json();

   
        }

 
        return view('livewire.plano')->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
