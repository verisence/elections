<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\StreamsController;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\VotersController;
use App\Http\Controllers\MessagesController;

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

// HOME
Route::get('/', 'App\Http\Controllers\DashboardController@index');

// STATIONS
Route::resource('stations', StationsController::class);
// Route::get('/stations', 'App\Http\Controllers\StationsController@index');

// STREAMS
Route::resource('streams', StreamsController::class);

// AGENTS
Route::resource('agents', AgentsController::class);
Route::post('agents/{key}/vote', 'App\Http\Controllers\AgentsController@vote')->name('agents_vote');

// PAYMENTS
Route::resource('payments', PaymentsController::class);

// VOTERS
Route::resource('voters', VotersController::class);

// SMS
Route::resource('messages', MessagesController::class);
