<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Barbearia;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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
        $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427'; 
        $barbeariaPix = Barbearia::withTrashed()->where("payment_method","PIX")->get();
        
        foreach($barbeariaPix as $barbearia){
            $horarioBrasilia = Carbon::now();
    
            if ($horarioBrasilia > Carbon::parse($barbearia->plan_ends_at)) { 
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
    
                $responsePayment = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                    'X-Idempotency-Key' => $idempotencyKey,
                ])->post("https://api.mercadopago.com/v1/payments?access_token={$accessToken}&preference_id={$preferenceID}", $paymentData);
                $barbearia->payment_id = $responsePayment['id'];
                $barbearia->save();
                if (Carbon::parse($responsePayment->json()['date_of_expiration']) < Carbon::now()) {
                    $barbearia->delete();
                }
            }
        }
    }
    
}
