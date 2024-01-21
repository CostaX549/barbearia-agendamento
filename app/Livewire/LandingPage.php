<?php

namespace App\Livewire;

use Livewire\Component;

class LandingPage extends Component
{
    public $subscriptionModal;
    public $isMercadoPagoButtonClicked = false;
    public $isStripeButtonClicked = false;

    public function clickMercadoPagoButton()
    {
        $this->isMercadoPagoButtonClicked = true;
        $this->isStripeButtonClicked = false;
    }

    public function clickStripeButton()
    {
        $this->isStripeButtonClicked = true;
        $this->isMercadoPagoButtonClicked = false;
    }

    public function pagar() {
        if($this->isStripeButtonClicked) {
              $this->redirect('/subscription-checkout');
        } else {
            $this->redirect('/checkout');
        }
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
