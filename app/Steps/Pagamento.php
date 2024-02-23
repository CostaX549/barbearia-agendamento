<?php

namespace App\Steps;

use App\Enums\DaysOfWeek;
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
use Illuminate\Support\Facades\Cache;
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
       

      
    }


        /*
     * When Wizard Form has submitted
     */
    public function save($state, $formData, $paymentMethod,$selectedPlan)
    {

          
             
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433'; 


        MercadoPagoConfig::setAccessToken($accessToken);
    

        $barbearia = new Barbearia;
        $barbearia->nome = $state['name'];
        $barbearia->cep = $state['cep'];
        $path = $state['imagem']->store('/', 's3');
        $barbearia->imagem =  $path;
        $barbearia->rua = $state['rua'];
        $barbearia->cidade = $state['cidade'];

       
        
        
     
        if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
        
            $barbearia->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
        } else {
       

            $barbearia->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
        }
        if (defined(PlanTypes::class . '::' . $selectedPlan)) {
            $barbearia->price = constant(PlanTypes::class . '::' . $selectedPlan);
        }
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
        $dia = null; 

        foreach ($state['dias'] as $index => $ativo) {
            if ($ativo) {

                $indexInt = $index;
        
               
                $dia = DaysOfWeek::from($indexInt);

 

                if ($dia !== null) {
                    BarbeiroWorkingHours::create([
                  
                        'barbeiro_id' => $barbeiro->id,
                        'day_of_week' => $dia->value, 
                        'start_hour' => $state['horariosIniciais'][$index],
                        'end_hour' => $state['horariosFinais'][$index],
                        'intervals' => [
                            'interval' => [
                                'start' => $state['intervaloInicial'][$index],
                                'end' => $state['intervaloFinal'][$index]
                            ]
                        ]
                    ]);
                }
            }
        }
  
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {

  


    $client = new PreApprovalClient();
  

    $preapprovalData = [

        
        
        
     
   'preapproval_plan_id' => '2c9380848dc7c710018dd27f7a900723',

      
        
         'payer_email'=> $formData['payer']['email'],
          
          'card_token_id' => $formData['token'],
        

        'external_reference' => $barbearia->id
      
    

    ];


        

    
  $assinatura = $client->create($preapprovalData);
 
  

   
  


   
    

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

        'payer' => [
           
            'email' => $formData['payer']['email'], 
          
        ],

    

        'external_reference' => $barbearia->id
    ];

    if ($formData['payment_method_id'] === 'bolbradesco') {

        $paymentData['payer']['identification']['type'] = $formData['payer']['identification']['type'];
$paymentData['payer']['first_name'] = $formData['payer']['first_name'];
$paymentData['payer']['last_name'] = $formData['payer']['last_name'];
           $paymentData['payer']['identification']['number'] = $formData['payer']['identification']['number'];
           $paymentData['payment_method_id'] = 'bolbradesco';
      
    } elseif($formData['payment_method_id'] === 'pec') {
        $paymentData['payer']['identification']['type'] = 'CPF';
        $paymentData['payer']['first_name'] = $formData['payer']['first_name'];
        $paymentData['payer']['last_name'] = $formData['payer']['last_name'];
           $paymentData['payer']['identification']['number'] = '12345678909';
           $paymentData['payment_method_id'] = 'pec';
    } else {
      
        $paymentData['payment_method_id'] = 'pix';
      
    }
  
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
            'X-Idempotency-Key' => $idempotencyKey,
        ])->post("https://api.mercadopago.com/v1/payments?access_token={$accessToken}&preference_id={$preferenceID}", $paymentData);


 
    $this->qrCode = $response->json();
    
    $barbearia->payment_id = $response->json()['id'];
    $barbearia->plan_ends_at = $response->json()['date_of_expiration'];
   $barbearia->save();
   return Redirect::route('barbearia.plano', ['slug' => $barbearia->slug]);
    
}
    

    
 

   



    

      
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {
    $barbearia->plan_id = $assinatura->id;
  
  $barbearia->plan_ends_at = Carbon::parse($assinatura->next_payment_date);

  $barbearia->save();
  
} 


   





 
      
   

    }   


  
    private function limparCacheBarbearias()
    {
  
        $cacheKey = "homepage-barbearias";
    
   
        Cache::forget($cacheKey);
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