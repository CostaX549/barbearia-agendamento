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
use App\Models\UserWorkingHours;
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
use App\Models\BarbeariaUser;
use MercadoPago\Net\MPSearchRequest;
use App\Enums\PlanTypes;
use App\Livewire\Plano;

class Pagamento extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'steps.pagamento';
    public $qrCode;
    public $cardIds = [];

 

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

       
        
        $barbearia_user = new BarbeariaUser;
        $barbearia_user->user_id = auth()->user()->id;
    
     
        if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
   
        $barbearia_user->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
          
        } else {
       

            $barbearia_user->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
        }
        $barbearia_user->price = constant(PlanTypes::class . '::' . 'mensal');
        $barbearia->estado = $state['estado'];
        $barbearia->complemento = $state['complemento'];      
        $barbearia->owner_id = auth()->user()->id;
        $barbearia->slug = $state['slug'];
        $barbearia->cpf = $state['cpf'];
 
        $barbearia->save();
        $barbearia_user->barbearia_id = $barbearia->id;
        $barbearia_user->save();
        $barbearia_user->delete();
       
        

        $dia = null; 

        foreach ($state['dias'] as $index => $ativo) {
            if ($ativo) {

                $indexInt = $index;
        
               
                $dia = DaysOfWeek::from($indexInt);

 

                if ($dia !== null) {
                    UserWorkingHours::create([
                  
                      
                 'barbearia_user_id' => $barbearia_user->id,
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
        

        'external_reference' => $barbearia_user->id
      
    

    ];


        

    try {
        $assinatura = $client->create($preapprovalData);

        // Faça algo com a assinatura criada, como salvar no banco de dados ou retornar uma resposta para o usuário
    } catch (\Exception $e) {
           dd($e);
    }
 
  
 Redirect::route('barbearia.billing', ['slug' => $barbearia->slug]);
   
  


   
    

} else {
    $preferenceID = '1660752433-f143c091-2454-40f0-9451-128b6ca2824a';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->get("https://api.mercadopago.com/checkout/preferences/{$preferenceID}");
    
    
    $preco = $response->json();
    
 
    $idempotencyKey = uniqid();
    
    $paymentData = [
         'transaction_amount'=> $preco['items'][0]['unit_price'] ,
       
        'description' => 'Pague o plano do barbeiro',

        'payer' => [
           
            'email' => $formData['payer']['email'], 
          
        ],

    

        'external_reference' => $barbearia_user->id
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


 

    
    $barbearia_user->payment_id = $response->json()['id'];
    $barbearia_user->plan_ends_at = $response->json()['date_of_expiration'];
   $barbearia_user->save();

   Redirect::route('barbearia.billing', ['slug' => $barbearia->slug]);
    
}
    

    
 

   



    

      
if($paymentMethod === 'debit_card' || $paymentMethod === 'credit_card' ) {
    $barbearia_user->assinatura_id = $assinatura->id;
  
  $barbearia_user->plan_ends_at = Carbon::parse($assinatura->next_payment_date);

  $barbearia_user->save();
  
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