<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barbearia;
use Carbon\Carbon;
class Pagamento
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function pagar(User $user){


        return 
        !$user->subscribed() ;
    }
}
