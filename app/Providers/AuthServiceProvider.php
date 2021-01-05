<?php

namespace App\Providers;

use App\Role;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
            return $user->hasRole('nasabah')
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai nasabah untuk mengakses halaman ini !');
        });

        Gate::define('pengurus-satu', function($user) {
            return $user->hasRole('pengurus-satu')
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai pengurus-satu untuk mengakses halaman ini !');
        });

        Gate::define('pengurus-dua', function($user) {
            return $user->hasRole('pengurus-dua')
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai pengurus-dua untuk mengakses halaman ini !');
        });

        Gate::define('bendahara', function($user) {
            return $user->hasRole('bendahara')
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai bendahara untuk mengakses halaman ini !');
        });

        Gate::define('admin', function($user) {
            return $user->hasRole('admin')
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai admin untuk mengakses halaman ini !');
        });
        
    }
}
