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
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427';


        
           
    
        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "cancelled"
            
        ]);
    
        $this->barbearia->delete();
      
    }
    public function pausarAssinatura(){
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427';

        
           
    
     Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "paused"
            
        ]);
    
        $this->barbearia->delete();
      
    }
    public function assinarNovamente(){
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427';


        
           
    
        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->plan_id, [
            
                'status' => "authorized"
            
        ]);
    
        
      
    }
public function assinar($formData,$paymentMethod){
    $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427'; 


    MercadoPagoConfig::setAccessToken($accessToken);




if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {
$client = new PreApprovalClient();


$preapprovalData = [

    
    
    
 
'reason' => $this->barbearia->nome,


  
    
     'payer_email'=> $formData['payer']['email'],
      'status' => "authorized",
      'card_token_id' => $formData['token'],
     'auto_recurring' => [
        'frequency' => 1,
        'frequency_type' => 'months',
        'transaction_amount' => 15,
        'currency_id' => 'BRL',
        'free_trial' => [
            'frequency' => 1,
            'frequency_type' => 'months',
        ],
    ],

  'back_url' => "https://mercadopago.com.br"


];


    

try {
$assinatura = $client->create($preapprovalData);


}  catch(\Exception $e) {
    dd($e);
}
}else{

    $payment = new PaymentClient();
    try {
    $paymentData = [
        'transaction_amount' => 1,
        'description' => 'Título do produto',
        'payment_method_id' => 'pix',
        'payer' => [
            'email' => $formData['payer']['email'],
            'first_name' => 'Test',
            'last_name' => 'User',
            'identification' => [
                'type' => 'CPF',
                'number' => '19119119100'
            ],
        
        ]
    ];
     $this->qrCode = $payment->create($paymentData);
    }
    catch(\Exception $e) {
        dd($e);
    }

}
$this->barbearia->plan_id = $assinatura->id;
$this->barbearia->save();
}






    public function render()
    {
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427';

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
