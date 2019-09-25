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


Route::post('/seance','StudentController@createSeance');
Route::post('/presence','StudentController@createPresence');
//Route::delete('/presence/students','StudentController@delete');
Route::post('/students','StudentController@create');