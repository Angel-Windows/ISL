<?php

namespace App\Providers;

use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Mockery\Container;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */


    public function register()
    {
        $this->app->bind(Telegram::class, function ($app){
//            return new Telegram(new Http(), "config('bots.bot')");
//            dd(config('bots.bot'));
            return new Telegram(new Http());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
