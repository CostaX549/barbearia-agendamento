<?php

namespace App\Livewire;

use App\Models\BarbeariaUser;
use App\Models\SpecificDate;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DatesList extends Component
{

    public BarbeariaUser $barbeiro;


#[Computed]
    public function datas() {
        return $this->barbeiro->specificDates;
    }

    public function delete($id) {
        $specificDate = SpecificDate::findOrFail($id);
        $specificDate->delete();
    }
    public function render()
    {
        return view('livewire.dates-list');
    }
}
