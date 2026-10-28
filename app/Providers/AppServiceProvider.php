<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;

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
        // Keep Windows environment variables for "php artisan serve"
        ServeCommand::$passthroughVariables[] = 'SystemRoot';
        ServeCommand::$passthroughVariables[] = 'Path';
    }
}
