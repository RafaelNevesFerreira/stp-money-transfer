<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\PostsRepositoryInterface',
            'App\Repositories\Eloquent\PostsRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\TagsRepositoryInterface',
            'App\Repositories\Eloquent\TagsRepository',
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
