<?php

namespace App\Steps;

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

             
        $accessToken = 'APP_USR-3577992641079180-011721-ff207db72804f196d2066d2931ed850c-1644143944'; 


        MercadoPagoConfig::setAccessToken($accessToken);
   
      

        $client = new PreApprovalPlanClient();
    $planData = [
        'reason' => $state['name'],
        'description' => 'Assinatura Mensal',
        'external_reference' => auth()->user()->id,
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

        'payment_methods_allowed' => [
            'payment_types' => [
                [
                    'id' => 'credit_card'
                ]
            ],
            'payment_methods' => [
                [
                    'id' => 'bolbradesco'
                    
                ],
               
            ]
                ],
        'application_fee' => 0.99,
   
        'back_url' => 'https://mercadopago.com.br',
    
    ];

    
    $responsePlan = $client->create($planData);

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
    catch (\Exception $e) {
        // Captura a exceção
        $error = $e->getMessage();
        // Faça o tratamento do erro conforme necessário
        dd($e);
    } 
    
  
  /*   
      
        
      
       $client = new PreApprovalClient();
  

        $preapprovalData = [

            
            
            
         
       'preapproval_plan_id' => $responsePlan->id,
    
          
            
             'payer_email'=>$formData['payer']['email'],
              
              
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

          
        
    
        ];

  
            
        if ($paymentMethod === 'credit_card' || $paymentMethod === 'debit_card') {
            $preapprovalData['preapproval_plan_id'] = $responsePlan->id;
            $preapprovalData['status'] = 'authorized';
            $preapprovalData['card_token_id'] =  $formData['token'];
        }
     
        $responsePreapproval = $client->create($preapprovalData);

       
        
    } catch (\Exception $e) {
        // Captura a exceção
        $error = $e->getMessage();
        // Faça o tratamento do erro conforme necessário
        dd($e);
    } */

        $barbearia = new Barbearia;
        $barbearia->nome = $state['name'];
        $barbearia->cep = $state['cep'];
        $path = $state['imagem']->store('uploads', 'public');
        $barbearia->imagem =  $path;
        $barbearia->rua = $state['rua'];
        $barbearia->cidade = $state['cidade'];
        $barbearia->estado = $state['estado'];
        $barbearia->complemento = $state['complemento'];
        $barbearia->owner_id = auth()->user()->id;
        $barbearia->slug = $state['slug'];
        $barbearia->cpf = $state['cpf'];
        $barbearia->save();
        
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
      
        
   

    $plan =  Plan::where('user_id', auth()->user()->id)->first();
    


        $plan->inscrito = 0;
        $plan->save();





 
      
   

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