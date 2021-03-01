<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        

        
        try{
            $this->app->bind('path.public', function() {
                return base_path().'/public';
            });
        }catch (exception $e) {
            $this->app->bind('path.public', function() {
                return base_path().'/public_html';
            });
        }

       
        // $this->app->bind('path.public', function() {
        //     return base_path().'/public';
        //     //return base_path().'/../public_html';
        // });
    }
}