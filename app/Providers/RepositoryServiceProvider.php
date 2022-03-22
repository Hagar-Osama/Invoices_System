<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            "App\Http\Interfaces\AuthInterface",
            "App\Http\Repositories\AuthRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\AdminInterface",
            "App\Http\Repositories\AdminRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\DepartmentInterface",
            "App\Http\Repositories\DepartmentRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\ProductsInterface",
            "App\Http\Repositories\ProductsRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\InvoicesInterface",
            "App\Http\Repositories\InvoicesRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\ArchiveInterface",
            "App\Http\Repositories\ArchiveRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\ReportsInterface",
            "App\Http\Repositories\ReportsRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\CustomersReportsInterface",
            "App\Http\Repositories\CustomersReportsRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\InvoiceAttachmentInterface",
            "App\Http\Repositories\InvoiceAttachmentRepository"
        );

        $this->app->bind(
            "App\Http\Interfaces\InvoiceDetailsInterface",
            "App\Http\Repositories\InvoiceDetailsRepository"
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
