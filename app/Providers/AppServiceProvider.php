<?php

namespace App\Providers;

use App\Models\Students;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('studenttable', function($view){
            $view->with('students', Students::All());
        });
        View::composer('teacherstable', function($view){
            $view->with('teachers', Teachers::All());
        });
    }
}
