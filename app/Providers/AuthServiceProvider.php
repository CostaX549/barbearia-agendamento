<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Barbearia;
use App\Models\Plan;
use App\Policies\BarbeariaPolicy;
use App\Policies\Pagamento;
use App\Models\User;
use App\Models\Agendamento;
use App\Policies\AgendamentoPolicy;
use App\Policies\SubscribedPolicy;
use App\Policies\AuthPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Barbearia::class => BarbeariaPolicy::class,
        User::class => AuthPolicy::class,
        Agendamento::class =>  AgendamentoPolicy::class,
        Plan::class => SubscribedPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
