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

  public function agendar(User $user, Barbearia $barbearia)
  {
      // Verifica se o usuário é o proprietário da barbearia e se a barbearia não está deletada
      return !$barbearia->trashed();
  }
}
