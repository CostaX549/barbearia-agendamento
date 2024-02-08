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
   
      $accessToken = 'TEST-3045657775074783-011813-d80b74d2be425de8d9abc56e759d6f7b-1642165427';

        try {
            if($request->input("type") === 'subscription_preapproval') {
  
         

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get('https://api.mercadopago.com/preapproval/' . $request->input("data.id"));

                Log::info($response->json());
                
                $externalReference = $response->json()['external_reference'];
                $existingPlan = Plan::where('user_id', $externalReference)->first();
                    

                if(!$existingPlan){

                
                    $plan = new Plan;
                    $plan->user_id = auth()->user()->id;
                    $plan->plan_id = $request->input("data.id");
                    $plan->status = $response['status'];
                    $plan->inscrito = 1;
                    $plan->price =$response['auto_recurring']['transaction_amount'] ;
                    $plan->trial_ends_at = Carbon::now()->addMonth();
                    $plan->ends_at = Carbon::now()->addMonth();
                    $plan->save();
                    }
              
          
                 elseif($response->json()['status'] === 'cancelled'){
                 
                    $plan = Plan::where('user_id', $externalReference)->first();
                    $plan->inscrito = 0;
                     $plan->save();
                 
                }else{
                    $plan = Plan::where('user_id',auth()->user()->id)->first(); 


                    $plan->plan_id = $request->input("data.id");
                    $plan->inscrito = 1;
                 
                    $plan->price = $response['auto_recurring']['transaction_amount'];
                    $plan->save();
                } 
            }
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
            $accessToken = 'APP_USR-3577992641079180-011721-ff207db72804f196d2066d2931ed850c-1644143944';
            $barbearia = Barbearia::withTrashed()->where('id', $response->json()['external_reference'])->first();
            $responseAssinaturasExistentes = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->get("https://api.mercadopago.com/preapproval/search", [
              'preapproval_plan_id' => '2c9380848d698da5018d7b8f887f0ca5'
            ]);

            Log::info( $responseAssinaturasExistentes->json());
  $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get("https://api.mercadopago.com/preapproval/{$request->input("data.id")}");

        Log::info($response->json());
        $assinaturaExistente = collect($responseAssinaturasExistentes['results'])->contains(function ($assinatura) use ($response) {
            return $assinatura['id'] === $response->json()['id'];
        });

        if($assinaturaExistente) {
            return;
        }
     if($response->json()['status'] === 'authorized') {
       
        $barbearia->plan_id = $response->json()['id'];
        $barbearia->save();
        $barbearia->restore();
     }
     if($response->json()['status'] === 'cancelled'){
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
    $barbearia->plan_ends_at = Carbon::parse($response['date_last_updated']);
    $barbearia->restore();
    
}

}
  }
    }

    
}
