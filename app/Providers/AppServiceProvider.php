<?php

namespace App\Providers;

use App\Constants\TaxConstants;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
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
        if (!Setting::has('tax.value')) {
            Setting::set('tax.value', TaxConstants::INITIAL_TAX);
        }

        if (!Setting::has('currency.id')) {
            Setting::set('currency.id', Currency::baseCurrency()->id);
        }
    }
}
