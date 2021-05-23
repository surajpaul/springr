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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
// 	Route::resource('/users', 'UsersController', ['except' => ['show', 'create','store']]);
// })

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('/users/edit', 'Admin\UsersController@edit')->name('user.edit');
    Route::post('/users/update', 'Admin\UsersController@update')->name('user.update');
    Route::post('/users/delete', 'Admin\UsersController@delete')->name('user.delete');
    Route::resource('/users', 'Admin\UsersController', ['except' => ['show','create']]);
});
