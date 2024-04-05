<?php

namespace App\Livewire;

use App\Models\Barbearia;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use MercadoPago\MercadoPagoConfig;
use App\Models\BarbeariaUser;
use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Client\Customer\CustomerCardClient;
use MercadoPago\Net\MPSearchRequest;

class Colaborador extends Component
{

    public Barbearia $barbearia;
    public $selectedBarbeiro;
    public $simpleModal;

    public function mount($slug) {
          $this->barbearia = Barbearia::where('slug', $slug)->first();
    }


    public function abrirModal(BarbeariaUser $barbeiro) {
        $this->simpleModal = true;
              $this->selectedBarbeiro =  $barbeiro;
    }

    public function cancelar(BarbeariaUser $barbeiro) {
       
        if($barbeiro->assinatura_id) {
      
            $barbeiro->payment_method = null;
            $barbeiro->assinatura_id = null;
            
            $barbeiro->save();
            $barbeiro->delete();
          
        }  elseif($barbeiro->payment_id) {
            $barbeiro->payment_method = null;
            $barbeiro->payment_id = null;
            $barbeiro->save();
        }
    }
    public function save($cardFormData) {
        try {
            MercadoPagoConfig::setAccessToken("TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433");
            $accessToken = "TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433";
            
            $customerResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get('https://api.mercadopago.com/v1/customers/search', [
                'email' => auth()->user()->email
            ]);
    
        
            $customer = json_decode($customerResponse->body());
    
            // Verifica se o cliente foi encontrado
            if (empty($customer->results)) {
                $client_customer = new CustomerClient();
                $customer = $client_customer->create(["email" => auth()->user()->email]);
    
            
                auth()->user()->payer_id = $customer->id;
                auth()->user()->save();
            } else {
               
                auth()->user()->payer_id = $customer->results[0]->id;
                auth()->user()->save();
            }
    
            $client_card = new CustomerCardClient();
            $client_card->create(auth()->user()->payer_id, ["token" => $cardFormData['token']]);
            
        } catch (\Exception $e) {
            dd($e);
        }
    }
    
    public function render()
    {

      
      
        
        $faturas = [];

        $faturas = [];

    foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
        try {
            $accessToken = "TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433"; // Substitua pelo seu token de acesso do MercadoPago

            if ($barbeiro->payment_method->value === 'PIX' || $barbeiro->payment_method->value === 'Boleto') {
                $response = Http::withToken($accessToken)->get('https://api.mercadopago.com/authorized_payments/search', [
                    'payment_id' => $barbeiro->payment_id,
                ]);
            } else {
                $response = Http::withToken($accessToken)->get('https://api.mercadopago.com/authorized_payments/search', [
                    'preapproval_id' => $barbeiro->assinatura_id,
                ]);
            }

            if ($response->successful()) {
                $faturas = array_merge($faturas, $response->json()['results']);
            } else {
                throw new \Exception('Falha ao buscar as faturas para o barbeiro ID: ' . $barbeiro->id);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
        
      
   
   
   
        return view('livewire.colaborador', [
            'faturas' => $faturas
        ]) ->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
          
        ]);
    }
}
