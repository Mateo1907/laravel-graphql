<?php

namespace App\Providers\Post;

use App\Services\PostService;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
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
        $this->app->bind('PostService', function($app){
            return new PostService($app->make('PostRepository'));
        });
    }
}
