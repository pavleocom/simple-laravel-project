<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Employee;
use App\Observers\CompanyObserver;
use App\Observers\EmployeeObserver;
use App\View\Components\FormErrors;
use App\View\Components\Breadcrumbs;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('form-errors', FormErrors::class);
        Blade::component('breadcrumbs', Breadcrumbs::class);

        Employee::observe(EmployeeObserver::class);
        Company::observe(CompanyObserver::class);
    }
}
