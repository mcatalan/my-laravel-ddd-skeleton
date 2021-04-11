<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Shared\Application\Bus\CommandBusInterface;
use Src\Shared\Application\Bus\ContainerInterface;
use Src\Shared\Infrastructure\Bus\CommandBus;
use Src\Shared\Infrastructure\Bus\LaravelContainer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ContainerInterface::class,
            LaravelContainer::class
        );

        $this->app->bind(
            CommandBusInterface::class,
            CommandBus::class
        );

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
