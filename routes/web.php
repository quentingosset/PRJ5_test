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

/**
 * IF MULTIPLE PROJECT ON WAMP/WWW/
 * use commande artisan to
 * php artisan serv
 */
Auth::routes();
Route::get('/', 'StudentController@accueil')->middleware('auth');
Route::get('/presence', 'StudentController@presence')->middleware('auth');
Route::post('/addSeance','Sceance@addSceance')->middleware('auth');
//Route::post('addStudent','StudentController@addStudent');
Route::get('/home', 'HomeController@index')->name('home');
