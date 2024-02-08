<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Plan;

class SubscribedPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
      
    }

 /*    public function inscrito(User $user, Plan $plan) {
        return $user->id === $plan->user_id && $plan->inscrito === 1;
    } */
}
