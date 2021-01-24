<?php

namespace App\Providers;

use App\View\Components\FormErrors;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Breadcrumbs;

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
        Blade::component('form-errors', FormErrors::class);
        Blade::component('breadcrumbs', Breadcrumbs::class);
    }
}
