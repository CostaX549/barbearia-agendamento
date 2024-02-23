<?php

namespace App\Policies;

use App\Models\User;

class AuthPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function authenticated(User $user)
    {
        return $user !== null;
    }
}
