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
      
        foreach($barbeariasPix as $barbearia){
            $horarioBrasilia = Carbon::now();
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
        }
    
    }
    
}
