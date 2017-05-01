<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Mail\Welcome;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LandingRegisterController extends Controller {

	use ValidatesRequests;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	public function register(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password'	=>	'required'
		]);

		$data = $this->prepareRegistration($request->all());

		$user = User::registerAndLogin($data);
		\Mail::to($user)->send(new Welcome($user));

		return redirect('/login');
	}

	private function prepareRegistration($data)
	{
		$data['firstname'] = 'Firstname';
		$data['lastname'] = 'Lastname';
		$data['email'] = $data['email'];
		$data['password'] = $data['password'];
		
		return $data;
	}
}
