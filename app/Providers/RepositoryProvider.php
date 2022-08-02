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

        $this->app->bind(
            'App\Repositories\Contracts\TransfersRepositoryInterface',
            'App\Repositories\Eloquent\TransfersRepository',
        );
        $this->app->bind(
            'App\Repositories\Contracts\CardsRepositoryInterface',
            'App\Repositories\Eloquent\CardsRepository',
        );
        $this->app->bind(
            'App\Repositories\Contracts\PlansRepositoryInterface',
            'App\Repositories\Eloquent\PlansRepository',
        );
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository',
        );
        $this->app->bind(
            'App\Repositories\Contracts\FaqRepositoryInterface',
            'App\Repositories\Eloquent\FaqRepository',
        );


        $this->app->bind(
            'App\Repositories\Contracts\ReviewsRepositoryInterface',
            'App\Repositories\Eloquent\ReviewsRepository',
        );


        $this->app->bind(
            'App\Repositories\Contracts\ContactRepositoryInterface',
            'App\Repositories\Eloquent\ContactRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\NotificationsRepositoryInterface',
            'App\Repositories\Eloquent\NotificationsRepository',
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
