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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
Route::patch('/update/{id}', 'UserController@update')->name('user.update');

Route::get('/edit_password/{id}', 'UserController@editPassword')->name('user.editPassword');
Route::patch('/update_password/{id}', 'UserController@updatePassword')->name('user.updatePassword');
