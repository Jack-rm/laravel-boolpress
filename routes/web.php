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

Route::get('/home', 'Guests\HomeController@index')->name('guests.home');

Auth::routes();

Route::middleware('auth')->namespace("Admin")->prefix('admin')->name('admin.')->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', PostController::class);
        Route::resource('users', UserController::class);
});
