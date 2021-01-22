<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('user_role', function($attribute, $value, $parameters, $validator) { // $validator->getData() consist of all request data that will be validated
            $user = User::firstWhere('id', $value);
            $role = $user->hasRole($parameters[1]);
            
            return $role;
        });
    }
}
