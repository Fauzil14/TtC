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

Route::group([ 'prefix' => 'auth' ], function($router) {
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
});

// Route::get('/home', 'Api\Nasabah\HomeNasabahController@index')->middleware('jwt.verify', 'can:nasabah');

Route::prefix('nasabah')->namespace('Api\Nasabah')->middleware(['jwt.verify', 'can:nasabah'])->group(function() {
    Route::get('home', 'HomeNasabahController@index');
    
    // profile
    Route::prefix('profile')->group(function() {
        Route::get('/', 'NasabahController@getAuthenticatedUser');
        Route::put('/update', 'NasabahController@updateProfileNasabah');
    });

    // penjemputan
    Route::prefix('penjemputan')->group(function() {
        Route::post('request', 'PenjemputanController@requestPenjemputan');
    });
});

// Route::namespace('Api\PengurusSatu')->prefix('pengurus_satu')->group(['middleware' => ['jwt.verify']], function() {
//     Route::get('home', 'HomePengurusSatuController@index');
// });

// Route::namespace('Api\PengurusDua')->prefix('pengurus_dua')->group(['middleware' => ['jwt.verify']], function() {
//     Route::get('home', 'HomePengurusDuaController@index');
// });

