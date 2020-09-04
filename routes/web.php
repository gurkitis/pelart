<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

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

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('auth/login');
});

Route::get('/localization/{locale}', 'LocalizationController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{id}', 'ProductController@show');
Route::post('/product/edit', 'ProductController@edit');

Route::get('/storage/create', 'StorageController@create');
Route::post('/storage/store', 'StorageController@store');
Route::get('/storage/index', 'StorageController@index');

Route::get('/delivery/create', 'DeliveryController@create');
Route::post('/delivery/create/update', 'DeliveryController@update');
Route::post('/delivery/store', 'DeliveryController@store');
Route::get('/delivery/index', 'DeliveryController@index');
Route::get('/delivery/show/{date}', 'DeliveryController@show');
Route::get('/delivery/delete/{id}', 'DeliveryController@delete');

Route::get('/price/index', 'PriceController@index');
Route::get('/price/show/{id}', 'PriceController@show');
Route::post('/price/store/buy', 'PriceController@store_buy');
Route::post('/price/edit/buy', 'PriceController@edit_buy');
Route::get('/price/delete/buy/{id}', 'PriceController@delete_buy');
Route::post('/price/store/sale', 'PriceController@store_sale');
Route::post('/price/edit/sale', 'PriceController@edit_sale');
Route::get('/price/delete/sale/{id}', 'PriceController@delete_sale');

Route::get('/type/create', 'TypeController@create');
Route::post('/type/store', 'TypeController@store');

Route::get('/sale/create', 'SaleController@create');
Route::post('/sale/create/getOptions', 'SaleController@getOptions');
Route::post('/sale/create/getPrice', 'SaleController@getPrice');
Route::post('/sale/store', 'SaleController@store');
Route::get('/sale/index', 'SaleController@index');
Route::get('/sale/show/{date}', 'SaleController@show');
Route::get('/sale/delete/{id}', 'SaleController@delete');

Route::get('/user/index', 'UserController@index');
Route::get('/user/delete/{id}', 'UserController@delete');
