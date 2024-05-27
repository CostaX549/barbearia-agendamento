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

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
    ])->get("https://api.mercadopago.com/v1/payments/{$request->input("data.id")}");
    
    $barbearia = BarbeariaUser::withTrashed()->where('id', $response->json()['external_reference'])->first();
if($response->json()['status']==='authorized'){
    $barbearia->plan_ends_at = Carbon::now()->addMonth();
    $barbearia->restore(); 
}

    if ($response->json()['status'] === 'cancelled') {
        $barbearia->payment_method = null;  
        $barbearia->payment_id = null;
        
        $barbearia->delete();
    }
    




  }
    }

    
}
