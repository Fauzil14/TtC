<?php

namespace App\Providers;

use App\Role;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $roles;

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

        $this->roles = Role::all()->toArray();
        
        //GATE
        Gate::define($this->roles[0]['role_name'], function($user) {
            return $user->hasRole($this->roles[0]['role_name'])
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai '  . $this->roles[0]['role_name'] . ' untuk mengakses halaman ini !');
        });

        Gate::define($this->roles[1]['role_name'], function($user) {
            return $user->hasRole($this->roles[1]['role_name'])
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai '  . $this->roles[1]['role_name'] . ' untuk mengakses halaman ini !');
        });

        Gate::define($this->roles[2]['role_name'], function($user) {
            return $user->hasRole($this->roles[2]['role_name'])
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai '  . $this->roles[2]['role_name'] . ' untuk mengakses halaman ini !');
        });

        Gate::define($this->roles[3]['role_name'], function($user) {
            return $user->hasRole($this->roles[3]['role_name'])
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai '  . $this->roles[3]['role_name'] . ' untuk mengakses halaman ini !');
        });

        Gate::define($this->roles[4]['role_name'], function($user) {
            return $user->hasRole($this->roles[4]['role_name'])
                            ? Response::allow()
                            : Response::deny('Anda harus login sebagai '  . $this->roles[4]['role_name'] . ' untuk mengakses halaman ini !');
        });
        
    }
}
