<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Result;
use App\Models\UserFav;
use App\Models\UserResult;
use App\Models\UserTest;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\ResultObserver;
use App\Observers\UserFavObserver;
use App\Observers\UserResultObserver;
use App\Observers\UserTestObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Result::observe(ResultObserver::class);
        UserFav::observe(UserFavObserver::class);
        UserResult::observe(UserResultObserver::class);
        UserTest::observe(UserTestObserver::class);
        app()->setLocale('ar');
    }
}
