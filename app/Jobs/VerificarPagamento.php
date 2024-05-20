<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Barbearia;
use App\Models\BarbeariaUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Enums\PaymentMethods;
use App\Livewire\Colaborador;
use MercadoPago\Client\PreApproval\PreApprovalClient;
class VerificarPagamento implements ShouldQueue
{      

    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433'; 
        $barbeariasPix = BarbeariaUser::whereIn("payment_method", [PaymentMethods::pix, PaymentMethods::bolbradesco])->where("price",15)->get();
        $barbeariaAssinatura =  BarbeariaUser::whereIn("payment_method", [PaymentMethods::credit_card, PaymentMethods::debit_card])->where("price",15)->get();

        //Fazer pix todo mês , caso o payment_id for nulo ele editou o plano, então ele irá criar um novo pagamento, para reniciar o plano na forma de pix ou boleto
        foreach($barbeariasPix as $barbearia){
            $horarioBrasilia = Carbon::now();

        if($barbearia->payment_id!=null){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get("https://api.mercadopago.com/v1/payments/{$barbearia->payment_id}");
         if($response['status'] !== "cancelled" && ($response['payment_method_id'] === "pix" ||$response['payment_method_id'] === "bolbradesco" )) {  
            if ($horarioBrasilia > Carbon::parse($barbearia->plan_ends_at)) { 
                $preferenceID = '1642165427-578edade-19d7-4033-a68d-52846af975ab';
    
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ])->get("https://api.mercadopago.com/checkout/preferences/{$preferenceID}");

       
                
                $preco = $response->json();
                
                $idempotencyKey = uniqid();
                $paymentMethod = strtolower($barbearia->payment_method->value);


                if ($paymentMethod === 'pix') {
                 
                    $paymentData = [
                        'transaction_amount'=> $preco['items'][0]['unit_price'],
                        'description' => 'Descrição do pagamento',
                        'payment_method_id' => 'pix',
                        'payer' => [
                            'email' => 'test_user_1498281909@testuser.com',
                        ],
                        'external_reference' => $barbearia->user_id
                    ];
                } elseif ($paymentMethod === 'boleto') {
                
                    $paymentData = [
                        'transaction_amount'=> $preco['items'][0]['unit_price'],
                        'description' => 'Descrição do pagamento',
                        'payment_method_id' => 'bolbradesco',
                        'payer' => [
                        'first_name' => 'Test',
                        'last_name' => 'User',
                        'email' => 'test_user_1498281909@testuser.com', 
                        'identification' => [
                            'type' => 'CPF', 
                            'number' => '12345678909', 
                        ],
                    ],
                        'external_reference' => $barbearia->user_id
                    ];
                }
    
                $responsePayment = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                    'X-Idempotency-Key' => $idempotencyKey,
                ])->post("https://api.mercadopago.com/v1/payments?access_token={$accessToken}&preference_id={$preferenceID}", $paymentData);
                $barbearia->payment_id = $responsePayment->json()['id'];
                
                $barbearia->save();
               
                
            }
        }
        }else{
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
        
                 $barbearia->payment_id = $response->json()["id"];

                    $barbearia->save();
        }
    }

           //Se caso ele estiver no pix e quiser trocar para assinatura , o assinatura_id irá ser nulo, então irá criar uma nova assinatura
          foreach($barbeariaAssinatura as $barbeiro){
                        if($barbeiro->assinatura_id == null && Carbon::now()>$barbearia->plan_ends_at){

                            $client = new PreApprovalClient();
  

                            $preapprovalData = [
                        
                                
                                
                                
                             
                           'preapproval_plan_id' => '2c9380848dc7c710018dd27f7a900723',
                        
                              
                                
                                 'payer_email'=> $formData['payer']['email'],
                                  
                                  'card_token_id' => $formData['token'],
                                
                        
                                'external_reference' => $barbearia->id
                              
                            
                        
                            ];
                        
                        
                            
                        
                            try {
                                $assinatura = $client->create($preapprovalData);
                        
                            } catch (\Exception $e) {
                                   dd($e);
                            }

                            $barbearia->assinatura_id = $assinatura->id;

                            $barbearia->save();
                             
                        }       
          }
    }
    
}
