<?php

use App\Http\Controllers\CultureController;
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

Route::get('cultures', 'CultureController@getAllCultures');
Route::get('cultures/{id}', 'CultureController@getCulture');
Route::get('cultures/search/{name}', 'CultureController@searchCultureByName');
Route::post('cultures', 'CultureController@createCulture');
Route::put('cultures/{id}', 'CultureController@updateCulture');
Route::delete('cultures/{id}','CultureController@deleteCulture');

