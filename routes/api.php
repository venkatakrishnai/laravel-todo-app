<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function (Request $request) {
    return "ok";
});

Route::post('/todo', 'ItemController@create');

Route::get('/todo', 'ItemController@index');
Route::get('/todo/{id}', 'ItemController@get');
Route::delete('/todo/{id}', 'ItemController@destroy');
Route::put('/todo/{id}', 'ItemController@update');
Route::patch('/todo/{id}/status', 'ItemController@updateStatus');

