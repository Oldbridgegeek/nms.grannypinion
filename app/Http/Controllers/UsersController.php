<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;
use App;

class UsersController extends Controller {

	public function show($user_id) {

		$user = $this->getUser($user_id);

		$feedbacksCount = $user->getFeedbacksCount();
		

		return view('user.show', compact(
			'user',
			'feedbacksCount'
		));
	}

	public function getUser($user_id)
	{
		$user = User::getUser($user_id);

		if ($user === null) {
			abort(404);
		}	

		return $user;
	}
}
