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

Route::name('welcome')->get('/', function () {
	return view('guest/welcome');
});

Route::middleware('auth')->group(function () {
	// Logged-In and Dashboard
	Route::get('/home', 'HomeController@index');

	// User
	Route::get('/searchuser', 'UserController@search');
	Route::get('/{user}', 'UserController@profile'); //show
	Route::get('/{user}/feedback', 'UserController@feedback');

	// Messaging and Conversations
	Route::get('/{user}/message', 'MessageController@message');
	Route::get('/{user}/myconversations', 'ConversationController@view_conversations');
	Route::get('/conversation/{conversation}', 'ConversationController@view_messages');
	Route::post('/message', 'MessageController@store');

	// Reviews
	Route::post('/feedback', 'ReviewsController@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
