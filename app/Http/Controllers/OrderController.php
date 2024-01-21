<?php

namespace App\Http\Controllers;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Order;
use App\Models\Agendamento;
use App\Models\Cortes;
use Carbon\Carbon;
use App\Models\Barbeiros;
class OrderController extends Controller
{

    public function index(Request $request)
    {
        session()->push('redirectToCheckoutSuccess', true);

        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
        $sessionId = $request->get('session_id');
       
try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

       
       
            $customer = \Stripe\Customer::retrieve($session->customer);
          
                return view('dashboard', compact('customer'));

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
 

    }

    public function webhook($orderId, $barbeiroId){
  
    }
    }

