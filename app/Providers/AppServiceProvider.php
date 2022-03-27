<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Observers\InvoicesObserver;
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
        Invoice::observe(InvoicesObserver::class);
    }
}
