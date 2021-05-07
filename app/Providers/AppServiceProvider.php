<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("ShopBase")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("ShopBase")->setRelease("1.0.0");
    }
}
