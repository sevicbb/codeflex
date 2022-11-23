<?php

namespace App\Providers;

use App\Constants\TaxConstants;
use App\Models\Setting;
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

        $this->applyDefaultSettings();
    }

    private function applyDefaultSettings()
    {
        if (!Setting::has('tax.value')) {
            Setting::set('tax.value', TaxConstants::INITIAL_TAX);
        }
    }
}
