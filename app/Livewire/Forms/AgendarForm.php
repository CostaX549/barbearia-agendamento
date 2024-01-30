<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AgendarForm extends Form
{
    #[Validate(['cortes.*' => 'required'])]
    public array $cortes = [];
    #[Validate('required')]    
    public $date;
    public $barbeiroSelecionado;
     #[Validate('required')]
    public $barbeiroModel;
    public $payment;

    public function store() {
        dd($this->date);
    }
}
