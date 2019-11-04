<?php

use Illuminate\Http\Request;

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

Route::get('/users', 'UsersController@index');
Route::get('/users/search', 'UsersController@search');
Route::post('/users', 'UsersController@create');
Route::get('/users/{id}', 'UsersController@show');
Route::put('/users/{id}', 'UsersController@update');
Route::delete('/users/{id}', 'UsersController@delete');
