<?php

namespace App\Providers\PasswordReset;

use App\PasswordReset;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PasswordResetRepository;

class PasswordResetRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('PasswordResetRepository', function($app) {
            return new PasswordResetRepository(new PasswordReset);
        });
    }
}
