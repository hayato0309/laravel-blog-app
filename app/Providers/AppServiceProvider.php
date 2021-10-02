<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

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

        Schema::defaultStringLength(191); // To avoid errors with InnoDB in Heroku

        Gate::define('isAdmin', function ($user) {
            foreach ($user->roles->all() as $role) {
                if ($role->slug == 'admin') {
                    return true;
                }
            }
        });
    }
}
