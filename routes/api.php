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

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'auth'], function($router) {
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
});

Route::prefix('nasabah')->group(['middleware' => ['jwt.verify']], function() {
    Route::get('nasabah/home', 'Api\Nasabah\HomeNasabahController@index');
});

// Route::namespace('Api\PengurusSatu')->prefix('pengurus_satu')->group(['middleware' => ['jwt.verify']], function() {
//     Route::get('home', 'HomePengurusSatuController@index');
// });

// Route::namespace('Api\PengurusDua')->prefix('pengurus_dua')->group(['middleware' => ['jwt.verify']], function() {
//     Route::get('home', 'HomePengurusDuaController@index');
// });

