<?php

namespace App\Console\Commands;

use App\Constants\CurrencyConstants;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Services\CurrencyConversionService;
use Illuminate\Console\Command;

/**
 * Class CurrencyRatesCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class CurrencyRatesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "currency_rates:load";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch available currency rates for the current date";

    /**
     * Contains the errors encountered
     *
     * @var array contains errors
     */
    protected $errors = [];

    public function __construct()
    {
        $this->currencyConversionService = new CurrencyConversionService();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $currencies = Currency::all()->filter(fn ($currency) => $currency->code !== CurrencyConstants::BASE_CURRENCY);

        CurrencyRate::query()->delete();

        foreach ($currencies as $currency) {
            CurrencyRate::create([
                'from_currency' => CurrencyConstants::BASE_CURRENCY,
                'to_currency' => $currency->code,
                'rate' => $this->currencyConversionService->fetchCurrencyRate($currency->code),
                'date' => now()
            ]);
        }
    }
}
