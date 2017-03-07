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
Route::get('/searchuser', 'UserController@search');
Auth::routes();
Route::get('/', function () {
	return view('main');
});

Route::get('/ranking', function () {
	return view('ranking');
});

Route::get('/{user}', 'UserController@profile');
Route::get('/{user}/feedback', 'UserController@feedback');
Route::get('/{user}/message', 'MessageController@message');
Route::get('/{user}/myconversations', 'ConversationController@view_conversations');
Route::get('/conversation/{conversation}', 'ConversationController@view_messages');

Route::post('/message', 'MessageController@store');

Route::post('/feedback', 'ReviewsController@store');
