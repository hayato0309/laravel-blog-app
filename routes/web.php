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

// For User
Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::patch('/user/{id}/update', 'UserController@update')->name('user.update');

Route::get('/user/{id}/password/edit', 'UserController@editPassword')->name('user.editPassword');
Route::patch('/user/password/{id}/update', 'UserController@updatePassword')->name('user.updatePassword');

// For Post
Route::get('/post/{id}', 'PostController@show')->name('post.show');
Route::get('/posts', 'PostController@list')->name('post.posts');
Route::get('/post', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
Route::patch('post/{id}/update', 'postController@update')->name('post.update');
Route::delete('/posts/{id}/delete', 'PostController@destroy')->name('post.destroy');

// For Comment
Route::post('/post/{id}/comment', 'CommentController@store')->name('comment.store');
Route::delete('/comment/{id}/comment/delete', 'CommentController@destroy')->name('comment.destroy');
