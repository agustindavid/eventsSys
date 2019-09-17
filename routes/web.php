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
    return view('auth.login');
});

Route::get('/calendar', 'CalendarController@index');
Route::get('/calendar/{venue}', 'CalendarController@calendar_venue');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate-contract/{event_id}','EventController@generatePDF');
Route::get('/expenses','EventController@eventBalance');
Route::get('/event_balance/{event}','EventController@eventBalanceShow');
Route::get('/stats',function(){
    return view('building');
});
Route::get('/pdf',function(){
    return view('events.contract');
});

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
