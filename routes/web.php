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
    Route::get('/user/index/{role}', 'UserController@indexUser')->name('user.index');
    Route::post('/user/tambah', 'UserController@tambahUser')->middleware('can:admin')->name('tambah.user');
    Route::put('/user/update', 'UserController@updateUser')->middleware('can:admin')->name('update.user');
    Route::get('/user/delete/{user_id}', 'UserController@delete')->middleware('can:admin')->name('delete.user');


    // Sampah
    Route::get('/sampah', 'SampahController@indexSampah')->name('sampah');
    Route::post('/sampah/tambah', 'SampahController@tambahSampah')->name('tambah.sampah');
    Route::post('/sampah/update', 'SampahController@updateSampah')->name('update.sampah');
    Route::get('/sampah/delete/{sampah_id}', 'SampahController@delete')->name('delete.sampah');

    Route::get('/profile/{user_id}', 'ProfileController@profileUser')->name('profile.user');
});