<?php

namespace App\Http\Controllers;


use App\Models\Plan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use App\Models\BarbeariaUser;

class Webhooks extends Controller
{
    public function webhook(Request $request){
   
      $accessToken = 'APP_USR-3577992641079180-011721-ff207db72804f196d2066d2931ed850c-1644143944';

     
    


        if($request->input("type") === 'subscription_preapproval' ) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get("https://api.mercadopago.com/preapproval/{$request->input("data.id")}");
            
            $accessToken = 'APP_USR-3577992641079180-011721-ff207db72804f196d2066d2931ed850c-1644143944';
            $barbearia = BarbeariaUser::withTrashed()->where('id', $response->json()['external_reference'])->first();




     if($response->json()['status'] === 'authorized') {
       
        $barbearia->assinatura_id = $response->json()['id'];
        $barbearia->plan_ends_at = $response->json()['next_payment_date'];
        $barbearia->save();
        $barbearia->restore();
     }
     if($response->json()['status'] === 'cancelled' || $response->json()['status'] === 'paused' ){
        if($barbearia->assinatura_id !=null){
        $barbearia->payment_method = null;  
        $barbearia->assinatura_id = null;
        
        $barbearia->delete();
        }
     }


  }

  if($request->input("type") === 'payment') {
    Log::info('Webhook recebido: pagamento detectado', ['data' => $request->all()]);

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
    ])->get("https://api.mercadopago.com/v1/payments/{$request->input("data.id")}");

    Log::info('Resposta do MercadoPago', ['response' => $response->json()]);

    $barbearia = BarbeariaUser::withTrashed()->where('id', $response->json()['external_reference'])->first();

    if ($barbearia) {
        Log::info('Resposta do MercadoPago Status', ['response' => $response->json()['status']]);

        if ($response->json()['status'] === 'approved') {
            Log::info("Pagamento autorizado para Barbearia ID: {$barbearia->id}");
            $barbearia->plan_ends_at = Carbon::now()->addMonth();
            $barbearia->restore(); 
        }

        if ($response->json()['status'] === 'cancelled') {
            Log::info("Pagamento cancelado para Barbearia ID: {$barbearia->id}");
            $barbearia->payment_method = null;  
            $barbearia->payment_id = null;
            $barbearia->delete();
        }
    } else {
        Log::warning('Barbearia não encontrada para o pagamento recebido.', ['external_reference' => $response->json()['external_reference']]);
    }
}

    }

    
}
