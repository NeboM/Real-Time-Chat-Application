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



Auth::routes();


// Because we want to pass data to `auth.login` view we define our own route
Route::get('login','PagesController@login')->name('login');

Route::get('/home', 'PagesController@home')->name('home')->middleware('auth');
Route::get('/','PagesController@users')->name('page.users')->middleware('auth');
Route::get('/{id}','PagesController@chat')->name('page.chat')->middleware('auth');
Route::post('/send/{id}','MessageController@store')->name('message.store')->middleware('auth');
Route::get('/chat/{id}','MessageController@getMessages')->name('chat.get')->middleware('auth');
