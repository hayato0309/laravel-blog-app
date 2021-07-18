<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            foreach ($user->roles->all() as $role) {
                if ($role->slug == 'admin') {
                    return true;
                }
            }
        });
    }
}
