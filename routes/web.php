<?php

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
    return view('welcome');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'clients' => 'ClientController',
    'services' => 'ServicesController',
    'venues' => 'VenuesController',
    'packages' => 'PackageController',
    'categories' => 'CategoryController',
    'quotes' => 'QuoteController',
    'events' => 'EventController',
    'payments' => 'PaymentController',
]);
