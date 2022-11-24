<?php

namespace App\Providers;

use App\Repositories\CurrencyRateRepository;
use App\Repositories\CurrencyRateRepositoryInterface;
use App\Repositories\CurrencyRepository;
use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\PartRepository;
use App\Repositories\PartRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\WarehousePartRepository;
use App\Repositories\WarehousePartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PartRepositoryInterface::class,
            PartRepository::class
        );

        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        $this->app->bind(
            CurrencyRepositoryInterface::class,
            CurrencyRepository::class
        );

        $this->app->bind(
            CurrencyRateRepositoryInterface::class,
            CurrencyRateRepository::class
        );

        $this->app->bind(
            WarehousePartRepositoryInterface::class,
            WarehousePartRepository::class
        );
    }
}
