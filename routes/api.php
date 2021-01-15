<?php

use Illuminate\Auth\Events\Verified;
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
   
// profile
Route::prefix('profile')->namespace('Api')->middleware(['jwt.verify', 'can:profile'])->group(function() {
    Route::get('/', 'ProfileController@getAuthenticatedUser');
    Route::put('/update', 'ProfileController@updateProfileNasabah');
});


Route::prefix('nasabah')->namespace('Api\Nasabah')->middleware(['jwt.verify', 'can:nasabah'])->group(function() {
    Route::get('home', 'HomeNasabahController@index');
 
    // penjemputan
    Route::prefix('penjemputan')->group(function() {
        Route::get('show-request', 'PenjemputanController@showRequestPenjemputan');
        Route::post('request', 'PenjemputanController@requestPenjemputan');
        Route::delete('request/cancel/{penjemputan_id}', 'PenjemputanController@batalkanRequestPenjemputan');
        Route::delete('request/cancel-item/{detail_penjemputan_id}', 'PenjemputanController@batalkanBarangRequestPenjemputan');
    });
});


Route::prefix('pengurus_satu')->namespace('Api\PengurusSatu')->middleware(['jwt.verify', 'can:pengurus-satu'])->group(function() {
    Route::get('home', 'HomePengurusSatuController@index');
    
    //penyetoran
    Route::prefix('penyetoran')->group(function() {
        Route::get('/show-request', 'PenyetoranController@showNasabahRequest');
        Route::get('/show-accepted-request', 'PenyetoranController@showAcceptedRequest');
        Route::get('/accept-request/{penjemputan_id}', 'PenyetoranController@acceptNasabahRequest');
        Route::get('/decline-request/{penjemputan_id}', 'PenyetoranController@declineNasabahRequest');
        Route::get('/show-nasabah-all', 'PenyetoranController@showAllNasabah');
        Route::post('/store', 'PenyetoranController@penyetoranNasabah');
        Route::get('/show-deposit', 'PenyetoranController@showPenyetoranNasabah');
        Route::get('/confirm-deposit/{penyetoran_id}', 'PenyetoranController@confirmDepositAsTransaksi');
    });
});

Route::prefix('pengurus_dua')->namespace('Api\PengurusDua')->middleware(['jwt.verify', 'can:pengurus-dua'])->group(function() {
    Route::get('home', 'HomePengurusDuaController@index');

    Route::prefix('penjualan')->group(function() {
        Route::get('/show-pengepul', 'PenjualanController@showPengepul');
        Route::post('/sell', 'PenjualanController@sellToPengepul');
    });
});

