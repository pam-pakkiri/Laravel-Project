<?php

namespace App\Providers;

// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        //Paginator::useBootstrap();

        if ( $this->isSecure() ) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

    }

    /**
     * -------------------------------------------------------------------------------
     *  isSecure
     * -------------------------------------------------------------------------------
    **/
    private function isSecure()
    {
        return (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] != 'off' || $_SERVER['HTTPS'] == '1')) || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    }

}
