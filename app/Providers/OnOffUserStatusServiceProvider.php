<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;

class OnOffUserStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('*',function($view){

            $onlineusers = User::onlineusers();

            $view->with([
                'onlineusers'=>$onlineusers
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}


// php artisan make:provider OnOffUserStatusServiceProvider
