<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barbearia;

class BarbeariaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Barbearia $barbearia){
        return $user->id=== $barbearia->owner_id;
  }
}
