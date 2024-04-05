<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Gallery extends Component
{

    public $barbearia;
    public $all = false;

#[Computed]
    public function galeria()
    {
     
        $barbeariaGallery = $this->barbearia->galeria ?? [];

    
        if ($this->all) {
            $response = Http::get('https://graph.instagram.com/me/media', [
                'fields' => 'id,caption,media_url',
                'access_token' => 'IGQWRQaF9QZADVpOU4zd0dPMVBoUTJXTi1NRW9BNXZAQdjh5NlFiSWY4MnhQb052XzFBOEg2YmdEU0REMkZA2ZA0QzMnI0dmNFMHU1TEROWFRTc2NuV3JETWMwZAE81TUtSYjJ6OHlOblZAfSlBsYjg4WG9aVmxmNHY2QjdGQ19OaHJPMXU5ZAwZDZD'
            ])->json();

            $instagramGallery = $response['data'] ?? [];

        
            $combinedGallery = array_merge($barbeariaGallery, $instagramGallery);
        } else {
          
            $combinedGallery = array_slice($barbeariaGallery, 0, 6);
        }


      
        return $combinedGallery;
    }

    public function render()
    {
        return view('livewire.gallery');
    }
}
