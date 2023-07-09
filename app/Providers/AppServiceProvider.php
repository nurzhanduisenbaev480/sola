<?php

namespace App\Providers;

use App\Models\Overhead;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Models\User;

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
    public function boot(Dashboard $dashboard): void
    {
        Dashboard::useModel(
            User::class,
            \App\Models\User::class
        );
        $dashboard->registerResource('scripts','/js/code.jquery.com_jquery-3.7.0.min.js');
        $dashboard->registerResource('scripts','/js/custom.js');
//        $dashboard->registerSearch([
//            Overhead::class
//        ]);
        //
    }
}
