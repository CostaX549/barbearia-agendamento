<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
#[Lazy]
class Jumbotron extends Component
{
    public $barbearia;

    public function placeholder() {
        return view ('placeholder');
    }
    public function render()
    {
        sleep(1);
        return view('livewire.jumbotron');
    }
}
