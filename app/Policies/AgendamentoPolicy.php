<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agendamento;


class AgendamentoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Agendamento $agendamento) {
        return $user->id === $agendamento->owner_id && !$agendamento->trashed();
    }
}
