<?php

namespace App\Providers;

use App\Constants\TaxConstants;
use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
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
        Paginator::useBootstrap();

        $this->defineMacros();

        $this->applyDefaultSettings();
    }

    private function defineMacros()
    {
        Builder::macro('whereLike', function ($columns, $search) {
            $this->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$search}%");
                }
            });

            return $this;
        });
    }

    private function applyDefaultSettings()
    {
        $settingRepository = App::make(SettingRepositoryInterface::class);
        $currencyRepository = App::make(CurrencyRepositoryInterface::class);

        if (!$settingRepository->has('tax.value')) {
            $settingRepository->set('tax.value', TaxConstants::INITIAL_TAX);
        }

        if (!$settingRepository->has('currency.id')) {
            $settingRepository->set('currency.id', $currencyRepository->getBaseCurrency()->id);
        }
    }
}
