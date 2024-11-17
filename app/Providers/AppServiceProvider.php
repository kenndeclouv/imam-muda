<?php

namespace App\Providers;

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
        // $this->registerPolicies();

        // Define a Gate for admin users
        Gate::define('isAdmin', function ($user) {
            return $user->Role->code === 'admin';
        });

        Gate::define('isSuperAdmin', function ($user) {
            return $user->Role->code === 'super_admin';
        });

        Gate::define('isImam', function ($user) {
            return $user->Role->code === 'imam';
        });
    }
}
