<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Plan;
use Illuminate\Http\Request;
use MercadoPago\Client\Invoice\InvoiceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\PreApprovalPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Barbearia;


class Webhooks extends Controller
{
    public function webhook(Request $request){
   
      $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';

        try {
            
            if($request->input("type") === 'payment') {
  
         

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get('https://api.mercadopago.com/v1/payments/' . $request->input("data.id"));

                Log::info($response->json());
                
               
                $existingPlan = Plan::where('user_id', auth()->user()->id)->first();
                    
                $paymentStatus = $response->json()['status'];
                $transactionAmount = $response->json()['transaction_amount'];

              
                if(!$existingPlan){

                
                $plan = new Plan;
                $plan->user_id = auth()->user()->id;
                $plan->plan_id = $request->input("data.id");
                $plan->status = $paymentStatus;
                $plan->inscrito = 1;
                $plan->price = $transactionAmount;
                $plan->trial_ends_at = Carbon::now()->addMonth();
                $plan->ends_at = Carbon::now()->addMonth();
                $plan->save();
                }
                elseif($paymentStatus ==='cancelled'){
                      
                    $plan = Plan::where('user_id', auth()->user()->id)->first();
                    $plan->inscrito = 0;
                     $plan->save();
                 
                     
                }
                else {
                    $plan = Plan::where('user_id',auth()->user()->id)->first(); 


                    $plan->plan_id = $request->input("data.id");
                    $plan->inscrito = 1;
                 
                    $plan->price = $transactionAmount;
                    $plan->save();
                }
            }

        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro no webhook: ' . $e->getMessage());
    
    
        } 

    


        if($request->input("type") === 'subscription_preapproval' ) {
            $accessToken = 'TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433';
            $barbearia = Barbearia::withTrashed()->where('id', $response->json()['external_reference'])->first();

  $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get("https://api.mercadopago.com/preapproval/{$request->input("data.id")}");


     if($response->json()['status'] === 'authorized') {
       
        $barbearia->plan_id = $response->json()['id'];
       
        $barbearia->save();
        $barbearia->restore();
     }
     if($response->json()['status'] === 'cancelled' || $response->json()['status'] === 'paused' ){
        $barbearia->payment_method = null;  
        $barbearia->payment_id = null;
        $barbearia->delete();
     }


  }

  if($request->input("type") === 'payment') {

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Accept' => 'application/json',
    ])->get("https://api.mercadopago.com/v1/payments/{$request->input("data.id")}");
    if($response->json()['status'] === 'authorized') {
    $barbearia = Barbearia::withTrashed()->where('id', $response->json()['external_reference'])->first();
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
