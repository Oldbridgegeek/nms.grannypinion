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

Route::name('welcome')->get('/', function () {
	return view('landing');
});

//Route::get('/', 'HomeController@index')->name('welcome');

// Route::middleware('auth')->group(function () {
// Logged-In and Dashboard
Route::get('/home', 'HomeController@index');
Route::get('/landing', function() {
	return view('landing');
});


// User
Route::name('user.setting')->get('/settings' , function() {
	return view('user.setting');
});
Route::get('/search/user', 'SearchController@search')->name('user.search');
Route::get('/{user}', 'UsersController@show')->name('user.show');
Route::get('/{user}/feedback/create', 'FeedbackController@create')->name('feedback.create');
Route::post('/settings/avatar', 'UsersController@update_avatar')->name('user.avatar');
Route::post('/update', 'UsersController@update')->name('user.update');

// Conversations and Messages
Route::get('/{user}/conversations', 'ConversationsController@index')->name('conversations');
Route::get('/conversation/{conversation}', 'ConversationsController@show')->name('conversation.show');
Route::post('/conversation', 'ConversationsController@store')->name('conversation.store');
Route::get('{user}/message', 'ConversationsController@create')->name('conversation.create');

// Reviews
Route::post('/feedback', 'ReviewsController@store');
// });


//Polls
Route::get('/{user}/polls', 'PollController@index')->name('poll.index');
Route::get('/poll/create', function() { return view('poll.create') ;} )->name('poll.create') ;
Route::post('/poll/store', 'PollController@store')->name('poll.store');
Route::get('/polls/{poll}','PollController@show')->name('poll.show');
