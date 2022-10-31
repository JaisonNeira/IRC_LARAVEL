<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            //TODO EL QUE TENGA ESTE CORREO NO NECESITARA PERMISOS PARA ACCEDER A CUALQUIER PARTE DEL PROGRAMA
            return $user->email == 'Admin@gmail.com' ?? null;
            //TODO EL QUE TENGA EL ROL ADMINISTRADOR NO NECESITARA PERMISOS PARA ACCEDER A CUALQUIER PARTE DEL PROGRAMA
            // return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
