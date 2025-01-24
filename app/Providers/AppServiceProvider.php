<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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
        //
        // DB::listen(function ($query) {
        //     logger($query->sql); // Çalıştırılan SQL sorgusunu loglar
        //     logger($query->bindings); // Sorguda kullanılan parametreleri loglar
        //     logger($query->time); // Sorgunun çalışma süresini loglar
        // });

        Paginator::useTailwind();
    }
}