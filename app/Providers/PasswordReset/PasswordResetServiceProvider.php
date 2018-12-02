<?php

namespace App\Providers\PasswordReset;

use App\Services\PasswordResetService;
use Illuminate\Support\ServiceProvider;

class PasswordResetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PasswordResetService', function($app){
            return new PasswordResetService($app->make('PasswordResetRepository'));
        });
    }
}
