<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@index');
Route::get('/login','HomeController@login');
Route::post('/login','Auth\AuthController@login');
Route::get('/register','HomeController@registration');
Route::post('/register','Auth\AuthController@register');
Route::get('/logout','Auth\AuthController@logout');
Route::get('/rooms', 'chatController@index');
Route::get('/create', 'chatController@create');
Route::post('/store', 'chatController@store');
Route::get('/room/{room}', 'chatController@open');
Route::get('/room/activate/{private_key}', 'chatController@activate');
Route::post('sendmessage', 'chatController@sendMessage');
Route::post('getmessage', 'chatController@getMessages');
