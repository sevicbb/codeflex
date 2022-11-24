## Getting Started

1. Copy ```.env.example``` file to ```.env```
2. ```composer install```
3. Create local database with the credentials located in ```.env```
4. Run ```php artisan migrate:fresh --seed``` to populate the initial dataset
5. Run ```php artisan currency_rates:load``` to load initial dataset for currency rates
6. ```php artisan serve```
