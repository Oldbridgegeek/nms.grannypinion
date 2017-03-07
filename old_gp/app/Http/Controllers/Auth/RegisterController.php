<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;

class RegisterController extends Controller {
	use RegistersUsers;
	protected $redirectTo = '/';

	public function __construct() {
		$this->middleware('guest');
	}

	protected function validator(array $data) {
		return Validator::make($data, [
			'firstname' => 'required|max:255',
		]);
	}

	protected function create(array $data) {
		$file = request()->file('profilePicture')->store('profilePictures');
		return User::create([
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'city' => $data['city'],
			'profilePicture' => $file,
			'verified' => false,
		]);
	}
}
