<?php

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

Route::get('/', 'Guests\HomeController@index')->name('guests.home');

Auth::routes();

Route::middleware('auth')->namespace("Admin")->prefix('admin')->name('admin.')->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', PostController::class);
        Route::resource('users', UserController::class);
});

//Reindirizzo tutte le rotte non specificate e che terminano con qualsiasi carattere verso la home dei guests
Route::get("{any?}", function(){
        return view('guests.home');
    })->where("any", ".*");