<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $App_Data = appMain();
        view()->share('APP_Name', $App_Data['Name']);
        view()->share('APP_Version', $App_Data['Version']);
        view()->share('APP_Developer', $App_Data['Developer']);
        view()->share('APP_LaunchDate', $App_Data['LaunchDate']);
        view()->share('APP_LaunchYear', $App_Data['LaunchYear']);
    }
}
