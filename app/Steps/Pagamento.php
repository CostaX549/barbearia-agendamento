<?php

namespace App\Steps;

use App\Enums\PaymentMethods;
use Vildanbina\LivewireWizard\Components\Step;

use Illuminate\Validation\Rule;
use App\Models\Barbearia;
use App\Models\Barbeiros;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Http;
use App\Models\BarbeiroWorkingHours;
use App\Models\Plan;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Client\Customer\CustomerCardClient;
use MercadoPago\Client\Preference\PreferenceClient;

use MercadoPago\Net\MPSearchRequest;
use App\Enums\PlanTypes;
use App\Livewire\Plano;

class Pagamento extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'steps.pagamento';
    public $qrCode;

 

    /*
     * Initialize step fields
     */
    public function mount()
    {
        $this->mergeState([
            'dias'                  => [],
     

         
            'horariosIniciais' => [
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
            ],
            'horariosFinais' => [
                '0' => '',
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => '',
                '5' => '',
                '6' => '',
            ],
       
        
        ]);
    }


        /*
     * When Wizard Form has submitted
     */
    public function save($state, $formData, $paymentMethod)
    {

       
             
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427'; 


        MercadoPagoConfig::setAccessToken($accessToken);

        $barbearia = new Barbearia;
        $barbearia->nome = $state['name'];
        $barbearia->cep = $state['cep'];
        $path = $state['imagem']->store('uploads', 'public');
        $barbearia->imagem =  $path;
        $barbearia->rua = $state['rua'];
        $barbearia->cidade = $state['cidade'];

            $barbearia->plan_ends_at = Carbon::now()->addMonth();
        
        
     
        if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
        
            $barbearia->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
        } else {
       

            $barbearia->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
        }
        $barbearia->price = PlanTypes::mensal;
        $barbearia->estado = $state['estado'];
        $barbearia->complemento = $state['complemento'];
        $barbearia->owner_id = auth()->user()->id;
        $barbearia->slug = $state['slug'];
        $barbearia->cpf = $state['cpf'];
 
        $barbearia->save();
        $barbearia->delete();
        
        $barbeiro = new Barbeiros;
        $barbeiro->name = auth()->user()->name;
        $barbeiro->avatar = 'teste';
        $barbeiro->barbearia_id = $barbearia->id;
        $barbeiro->save();
        
        foreach ($state['dias'] as $index => $dia) {
        
        
          BarbeiroWorkingHours::create([
              'barbeiro_id' => $barbeiro->id,
              'day_of_week' => $dia,
              'start_hour' => $state['horariosIniciais'][$index],
              'end_hour' => $state['horariosFinais'][$index],
          ]);
        }
      
  
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {

  


    $client = new PreApprovalClient();
  

    $preapprovalData = [

        
        
        
     
   'preapproval_plan_id' => '2c9380848d698d98018d849f908c12ae',

      
        
         'payer_email'=> $formData['payer']['email'],
          
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

        'external_reference' => $barbearia->id
      
    

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
    $preferenceID = '1642165427-71f2702e-a83b-4853-bd6b-957305edde95';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->get("https://api.mercadopago.com/checkout/preferences/{$preferenceID}");
    
    
    $preco = $response->json();
    
    
    $idempotencyKey = uniqid();
    $paymentData = [
         'transaction_amount'=> $preco['items'][0]['unit_price'],
    
        'description' => 'Descrição do pagamento',
        'payment_method_id' => 'pix', 
        'payer' => [
            'email' => 'test_user_1498281909@testuser.com', 
        ],

        'external_reference' => $barbearia->id
    ];
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
        'X-Idempotency-Key' => $idempotencyKey,
    ])->post("https://api.mercadopago.com/v1/payments?access_token={$accessToken}&preference_id={$preferenceID}", $paymentData);
       
      
    $this->qrCode = $response->json();

    $barbearia->payment_id = $response->json()['id'];
    
   $barbearia->save();
   return Redirect::route('barbearia.plano', ['slug' => $barbearia->slug]);
    
}
    

    
 

   



    

      
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {
    $barbearia->plan_id = $assinatura->id;
  
  $barbearia->plan_ends_at = Carbon::parse($assinatura->next_payment_date);
  $barbearia->card_id = $responseCartaoCliente[0]['id'];
  $barbearia->save();
  
} 


   





 
      
   

    }   


  
    
    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'credit-card';
    }



 



    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Pagamento');
    }
}