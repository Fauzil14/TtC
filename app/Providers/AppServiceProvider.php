<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use NumberFormatter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
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

        /* Costum Validation */
        // Note : Validator::extend($par1 = "name of the rule", $par2 = extension, $par3 = "message")
        // $rule = the attribute name of the rule assign to
        // $value = the value of the attribute
        // $parameters = the values from the rule parameters ex: custom_rule:val1,val2,val3 

        Validator::extend('user_role', function($attribute, $value, $parameters, $validator) { // $validator->getData() consist of all request data that will be validated

            $user = User::firstWhere('id', $value);
            
            if(empty($user)) {
                $result = FALSE;
                $custom_message = "doesn't exist !";
            } elseif ($parameters[0] == 'roles') {
                $arr_params = array_slice($parameters,1);
                $result = $user->hasAnyRoles($arr_params);
                $custom_message = "is not " . implode(" or ", $arr_params);
            } else {
                $result = $user->hasRole($parameters[1]);
                $custom_message = "is not $parameters[1]";
            }

            // in case you need to manage dynamic variable inside the extend function
            $validator->addReplacer('user_role', function($message, $attribute, $rule, $paramaters) use ($custom_message) {
                return str_replace(':custom_message', $custom_message, $message);
            });

            return $result;
        }, "The selected user :custom_message");

        
        Str::macro('decimalForm', function($value, $is_currency = false) {
            if( $is_currency == true ) {
                $fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                return $fmt->formatCurrency($value, "IDR");
            } 
            
            if( is_numeric($value) && floor($value) != $value ) {
                $decimals = (strlen($value) - strpos($value, '.')) - 1;
                return number_format($value, $decimals, ',', '.');
            } else {
                return number_format($value, 0, ',', '.');
            }
        });

        Route::macro('checkRoute', function($prefix, $params = null) {
            $route = Route::current();
            switch (TRUE) {
                case $route->action['prefix'] == $prefix && is_null($params) : 
                    return true;
                case $route->action['prefix'] == $prefix && $route->parameters['role'] == $params :
                    return true;
                default : 
                    return false;
            }
            
        });

    }
}
