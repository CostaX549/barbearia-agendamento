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
   
      $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';

     
    


        if($request->input("type") === 'subscription_preapproval' ) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get("https://api.mercadopago.com/preapproval/{$request->input("data.id")}");
            
            $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';
            $barbearia = BarbeariaUser::withTrashed()->where('id', $response->json()['external_reference'])->first();




     if($response->json()['status'] === 'authorized') {
       
        $barbearia->assinatura_id = $response->json()['id'];
       
        $barbearia->save();
        $barbearia->restore();
     }
     if($response->json()['status'] === 'cancelled' || $response->json()['status'] === 'paused' ){
        $barbearia->payment_method = null;  
        $barbearia->assinatura_id = null;
        $barbearia->delete();
     }


  }

  if($request->input("type") === 'payment') {

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
    ])->get("https://api.mercadopago.com/v1/payments/{$request->input("data.id")}");
    if($response->json()['status'] === 'authorized') {
    $barbearia = BarbeariaUser::withTrashed()->where('id', $response->json()['external_reference'])->first();
if($response->json()['status']==='authorized'){
    $barbearia->plan_ends_at = Carbon::now()->addMonth();
    $barbearia->restore(); 

    if ($response->json()['status'] === 'cancelled') {
        $barbearia->payment_method = null;  
        $barbearia->payment_id = null;
        
        $barbearia->delete();
    }
    
}


}
  }
    }

    
}
