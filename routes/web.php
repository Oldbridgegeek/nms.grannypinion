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
use Illuminate\Http\Request;
use App\Feedback;

Auth::routes();
Route::get('test', function(){
	factory(App\FeedbackComment::class, 2)->create();
});
Route::get('/email/confirmation/{token}', 
	'Auth\EmailConfirmationController@confirm')
		->name('email.confirmation');

Route::post('/user/addComment', "FeedbackCommentsController@add");	


Route::name('welcome')->get('/', function () {
	return view('landing');
});

// Route::middleware('auth')->group(function () {
// Logged-In and Dashboard
Route::get('/home', 'HomeController@index');
Route::get('/landing', function() {
	return view('landing');
});


// User Settings
Route::get('/settings' , 'SettingsController@settings')->name('user.setting');
Route::post('/settings/update' , 'SettingsController@update');

//User Profile
Route::get('/search/user', 'SearchController@search')->name('user.search');
Route::get('/{user}', 'UsersController@show')->name('user.show');

//Feedback addition
Route::get('/{user}/feedback/create', 'FeedbackController@create')->name('feedback.create');
Route::post('/{user}/feedback/leave', 'FeedbackController@leave');
Route::get('/feedback/success', 'FeedbackController@success');


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
Route::get('/reply/{poll}', 'ReplyController@create');
Route::post('/reply/store', 'ReplyController@store')->name('reply.store');

//Subscriber
Route::post('/subscribe', 'SubcribersController@store')->name('subscribe');

