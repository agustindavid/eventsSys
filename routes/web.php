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

use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', 'CalendarController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/checkdates/{venue}/{date}', 'QuoteController@check_dates');
Route::resources([
    'clients' => 'ClientController',
    'services' => 'ServicesController',
    'venues' => 'VenuesController',
    'packages' => 'PackageController',
    'categories' => 'CategoryController',
    'quotes' => 'QuoteController',
    'events' => 'EventController',
    'users' =>'UsersController',
]);
