<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = auth()->user();
            $view->with('user', $user);
        });

        View::composer('partials.who-to-follow', function ($view) {
            $users = auth()->user()->notFollowing()->limit(10)->get();
            $view->with('users', $users);
        });

        View::composer('partials.user-profile', function ($view) {
            $view->with('tweetCount', $view->user->tweets()->count());
            $view->with('followerCount', $view->user->followers()->count());
            $view->with('followingCount', $view->user->following()->count());
        });
    }
}
