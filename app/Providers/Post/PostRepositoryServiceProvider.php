<?php

namespace App\Providers\Post;

use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class PostRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('PostRepository', function($app) {
            return new PostRepository(new Post);
        });
    }
}
