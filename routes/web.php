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

// Route::middleware('auth')->group(function () {
	// Logged-In and Dashboard
	Route::get('/home', 'HomeController@index');

	// User
	Route::get('/search/user', 'SearchController@search')->name('user.search');
	Route::get('/{user}', 'UsersController@show')->name('user.show');
	Route::get('/{user}/feedback', 'FeedbackController@index')->name('feedback');
	Route::get('/{user}/feedback/create', 'FeedbackController@create')->name('feedback.create');

	// Conversations and Messages
	Route::get('/{user}/conversations', 'ConversationsController@index')->name('conversations');
	Route::get('/conversation/{conversation}', 'ConversationsController@show')->name('conversation.show');
	Route::post('/conversation', 'ConversationsController@store')->name('conversation.store');
	Route::get('{user}/message', 'ConversationsController@create')->name('conversation.create');

	// Reviews
	Route::post('/feedback', 'ReviewsController@store');
// });

Auth::routes();

Route::get('/home', 'HomeController@index');
