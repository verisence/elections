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
Route::post('station/{key}/create_stream', 'App\Http\Controllers\StationsController@createStream');

// STREAMS
Route::resource('streams', StreamsController::class);
Route::post('streams/{key}/create_agent', 'App\Http\Controllers\StreamsController@createAgent');

// AGENTS
Route::resource('agents', AgentsController::class);
Route::post('agents/{key}/vote', 'App\Http\Controllers\AgentsController@vote')->name('agents_vote');
Route::post('agents/{key}/make_payment', 'App\Http\Controllers\AgentsController@makePayment');

// PAYMENTS
Route::resource('payments', PaymentsController::class);

// VOTERS
Route::resource('voters', VotersController::class);

// SMS
Route::resource('messages', MessagesController::class);
