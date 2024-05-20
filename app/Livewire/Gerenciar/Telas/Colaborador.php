<?php

namespace App\Livewire\Gerenciar\Telas;

use App\Models\Barbearia;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On;
use MercadoPago\MercadoPagoConfig;
use App\Models\BarbeariaUser;
use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Client\Customer\CustomerCardClient;
use MercadoPago\Net\MPSearchRequest;
use Illuminate\Support\Facades\Cache;
use App\Enums\PaymentMethods;


class Colaborador extends Component
{

    public Barbearia $barbearia;
    public $selectedBarbeiro;
    public $paymentMethods = [];
    public $simpleModal;
    public $payerEmail;
    public ?BarbeariaUser $isEditing;
    

    public function mount($slug) {
          $this->barbearia = Barbearia::where('slug', $slug)->first();
    }
  

    public function abrirModal(BarbeariaUser $barbeiro) {
        $this->simpleModal = true;
              $this->selectedBarbeiro =  $barbeiro;
    }


    public function editarAssinatura(BarbeariaUser $barbeiro, $formData,$paymentMethod){
        $accessToken = "TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433";
             if($barbeiro->payment_method->value == "Cartão de Crédito" || $barbeiro->payment_method->value == "Cartão de Débito" ){
                          if($paymentMethod == "debit_card" || $paymentMethod == "credit_card" ){
                                  $barbeiro->payment_id = null;
                            if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
        
                                $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
                            } else {
                           
                    
                                $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
                            }
                            $response =  Http::withHeaders([
                                'Authorization' => 'Bearer ' . $accessToken,
                                'Content-Type' => 'application/json',
                            ])->put('https://api.mercadopago.com/preapproval/' . $this->barbearia->assinatura_id, [
                                
                                    "card_token_id"=> $formData['token']
                                
                            ]); 
                            
                            $barbeiro->save();
                          }else{

                            $assinatura =  $barbeiro->assinatura_id;

                            $barbeiro->assinaura_id = null;
         
                         if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
                 
                             $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
                         } else {
                        
                 
                             $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
                         }
                               $formData["payer"]["email"];
                           $barbeiro->save();
         
                         $response =  Http::withHeaders([
                             'Authorization' => 'Bearer ' . $accessToken,
                             'Content-Type' => 'application/json',
                         ])->put('https://api.mercadopago.com/preapproval/' .  $assinatura, [
                             
                                 'status' => "cancelled"
                             
                         ]);
                                      
                      


                          }
             }else{

                 
                if (defined(PaymentMethods::class . '::' . $formData['payment_method_id'])) {
                 
                    $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $formData['payment_method_id']);
                } else {
               
        
                    $barbeiro->payment_method = constant(PaymentMethods::class . '::' . $paymentMethod);
                }


                 $barbeiro->payment_id = null;


               
                             
             }
    }

    public function edit(BarbeariaUser $barbeiro) {
            $this->isEditing = $barbeiro;

    }

    #[On('cancelEditMode')]
    public function cancelarEdicao() {
        $this->isEditing = null;
    }

    public function adicionarMetodos() {
           
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

            Cache::forget('mercado_pago_cards_' . auth()->user()->payer_id);
            
        } catch (\Exception $e) {
            dd($e);
        }
    }
    
    public function render()
    {
        $faturas = [];
    
        // Tente recuperar os dados do cache
        $faturas = Cache::remember('faturas_' . $this->barbearia->id, now()->addHours(1), function () {
            $faturas = [];
    
            $barbeiro = $this->barbearia->barbeiros()->withTrashed()->first();
    
            foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
                try {
                    $accessToken = "TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433";
    
                    if ($barbeiro->payment_method?->value === 'PIX' || $barbeiro->payment_method?->value === 'Boleto') {
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
                        $faturas = [];
                    }
                } catch (\Exception $e) {
                    dd($e);
                }
            }
    
            return $faturas;
        });
    
        return view('livewire.gerenciar.telas.colaborador', [
            'faturas' => $faturas
        ])->layout('components.layouts.barbearia', [
            'barbearia' => $this->barbearia,
        ]);
    }
}
