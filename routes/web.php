<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

Route::prefix('dashboard')->middleware(['verified', 'can:management-web'])->group(function() {
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
    
    // User
    Route::get('/user/nasabah', 'UserController@indexNasabah')->name('user.nasabah');
    Route::get('/user/pengurus-satu', 'UserController@indexPengurusSatu')->name('user.pengurus-satu');
    Route::get('/user/pengurus-dua', 'UserController@indexPengurusDua')->name('user.pengurus-dua');
    Route::get('/user/bendahara', 'UserController@indexBendahara')->name('user.bendahara');
    Route::post('/user/tambah', 'UserController@tambahUser')->middleware('can:admin')->name('tambah.user');
    Route::put('/user/update', 'UserController@updateUser')->middleware('can:admin')->name('update.user');
    Route::get('/user/delete/{user_id}', 'UserController@delete')->middleware('can:admin')->name('delete.user');


    // Sampah
    Route::get('/sampah', 'SampahController@indexSampah')->name('sampah');
    Route::post('/sampah/tambah', 'SampahController@tambahSampah')->name('tambah.sampah');

});