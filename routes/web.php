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

// HOME
Route::get('/', 'App\Http\Controllers\DashboardController@index');

// STATIONS
Route::get('/stations', 'App\Http\Controllers\StationsController@index');

// AGENTS
Route::get('/agents', 'App\Http\Controllers\AgentsController@index');

// VOTERS
Route::get('/voters', 'App\Http\Controllers\VotersController@index');

// SMS
Route::get('/sms', 'App\Http\Controllers\MessagesController@index');
