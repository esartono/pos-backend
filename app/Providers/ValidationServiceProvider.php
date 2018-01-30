<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('kana', 'App\Validator\CustomValidators@isValidKana');
        Validator::extend('alphanumeric', 'App\Validator\CustomValidators@isValidAlphanumeric');
        Validator::extend('phone', 'App\Validator\CustomValidators@isValidPhoneNumber');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
