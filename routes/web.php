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
    Route::get('/nasabah', 'NasabahController@index')->name('nasabah');
    Route::post('/nasabah/tambah', 'NasabahController@tambahNasabah')->middleware('can:admin')->name('tambah.nasabah');
    Route::put('/nasabah/udpate', 'NasabahController@udpateNasabah')->middleware('can:admin')->name('udpate.nasabah');
    Route::get('/nasabah/delete/{user_id}', 'NasabahController@delete')->middleware('can:admin')->name('delete.nasabah');
});