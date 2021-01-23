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
        // Note : Validator::extend($par1 = "name of the rule", $par2 = extension, $par3 = "message")
        // $rule = the attribute name of the rule assign to
        // $value = the value of the attribute
        // $parameters = the values from the rule parameters ex: custom_rule:val1,val2,val3 

        Validator::extend('user_role', function($attribute, $value, $parameters, $validator) { // $validator->getData() consist of all request data that will be validated
            $custom_message = "is not $parameters[1]"; 
            
            $user = User::firstWhere('id', $value);
            
            if(empty($user)) {
                $result  = FALSE;
                $custom_message = "doesn't exist !";
            } else {
                $result = $user->hasRole($parameters[1]);
            }

            // in case you need to manage dynamic variable inside the extend function
            $validator->addReplacer('user_role', function($message, $attribute, $rule, $paramaters) use ($custom_message) {
                return str_replace(':custom_message', $custom_message, $message);
            });

            return $result;
        }, "The selected user :custom_message");

    }
}
