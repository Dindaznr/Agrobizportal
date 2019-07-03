<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use App\Http\ViewComposers\MenuComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setLocale(LC_TIME, config('app.locale'));

        view()->composer('components.sidebar', MenuComposer::class);

        Blade::if('admin', function () {
            return auth()->user()->role === 'admin';
        });

        Blade::if('seller', function () {
            return auth()->user()->role === 'seller';
        });
        
        Blade::if('customer', function () {
            return auth()->user()->role === 'customer';
        });

        Blade::if('request', function ($url) {
            return request()->is($url);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
