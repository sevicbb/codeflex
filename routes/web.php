<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\PartController@index')->name('part.index');
Route::post('/update-tax', 'App\Http\Controllers\PartController@updateTax')->name('part.update_tax');
Route::post('/update-warehouse', 'App\Http\Controllers\PartController@updateWarehouse')->name('part.update_warehouse');
Route::post('/update-inventory', 'App\Http\Controllers\PartController@updateInventory')->name('part.update_inventory');
