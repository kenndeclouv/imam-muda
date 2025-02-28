<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
    public function boot()
    {
        // set timezone carbon global
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        Response::macro('pwaHeaders', function ($response) {
            return $response->header('Service-Worker-Allowed', '/');
        });
    }
}
