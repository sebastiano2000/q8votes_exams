<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Result;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\ResultObserver;

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
        app()->setLocale('ar');
    }
}
