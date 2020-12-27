<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //GATE
        Gate::define('nasabah', function($user) {
            return $user->hasRole('nasabah');
        });

        Gate::define('pengurus-1', function($user) {
            return $user->hasRole('pengurus satu');
        });

        Gate::define('pengurus-2', function($user) {
            return $user->hasRole('pengurus dua');
        });

        Gate::define('bendahara', function($user) {
            return $user->hasRole('bendahara');
        });

        Gate::define('admin', function($user) {
            return $user->hasRole('admin');
        });
    }
}
