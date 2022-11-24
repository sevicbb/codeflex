<?php

namespace App\Console\Commands;

use App\Constants\CurrencyConstants;
use App\Repositories\CurrencyRateRepositoryInterface;
use App\Repositories\CurrencyRepositoryInterface;
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

    public function __construct(
        CurrencyRepositoryInterface $currencyRepository,
        CurrencyRateRepositoryInterface $currencyRateRepository,
        CurrencyConversionService $currencyConversionService
    ) {
        $this->currencyRepository = $currencyRepository;
        $this->currencyRateRepository = $currencyRateRepository;
        $this->currencyConversionService = $currencyConversionService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $currencies = $this->currencyRepository->allWhereNot('code', CurrencyConstants::BASE_CURRENCY);

        $this->currencyRateRepository->deleteAll();

        $currencyRates = [];

        foreach ($currencies as $currency) {
            $currencyRates[] = [
                'from_currency' => CurrencyConstants::BASE_CURRENCY,
                'to_currency' => $currency->code,
                'rate' => $this->currencyConversionService->fetchCurrencyRate($currency->code),
                'date' => now()
            ];
        }

        $this->currencyRateRepository->insert($currencyRates);
    }
}
