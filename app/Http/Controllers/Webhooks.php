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


class Webhooks extends Controller
{
    public function webhook(Request $request){
   
        $accessToken = 'TEST-4528145694266395-011813-76b485df71f80a98e8d91e4c222c02bc-1644184890';

     
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
                $plan->user_id = $response->json()['external_reference'];
                $plan->plan_id = $request->input("data.id");
                $plan->status = 'Trialing';
                $plan->inscrito = 1;
                $plan->price = $response->json()['auto_recurring']['transaction_amount'];
                $plan->trial_ends_at = Carbon::now()->addMonth();
                $plan->ends_at = Carbon::now()->addMonth();
                $plan->save();
                }elseif($response->json()['status'] === 'cancelled'){
                 
                    $plan = Plan::where('user_id', $externalReference)->first();
$plan->inscrito = 0;
$plan->save();
                 
                } else {
                    $plan = Plan::where('user_id', $externalReference)->first(); 


                    $plan->plan_id = $request->input("data.id");
              $plan->inscrito = 1;
                 
                    $plan->price = $response->json()['auto_recurring']['transaction_amount'];
                    $plan->save();
                }
            }
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro no webhook: ' . $e->getMessage());
    
    
        }
    }
}
