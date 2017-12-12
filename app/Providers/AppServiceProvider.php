<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('image_extension', function ($attribute, $value, $parameters, $validator) {                        
            if (!empty($value) && method_exists($value, 'getClientOriginalExtension')) {
                $arrayAllowedExtension = ['jpg', 'png', 'jpeg', 'gif'];

                if ($value->getClientOriginalExtension() == "" || !in_array(strtolower($value->getClientOriginalExtension()), $arrayAllowedExtension)) {
                    return false;
                }
            }
            return true;            
        });
        
        Validator::replacer('image_extension', function ($message, $attribute, $rule, $parameters) {
            
            return str_replace([':attribute'], $parameters, $message);
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register('\Barryvdh\Debugbar\ServiceProvider');
        }
    }
}
