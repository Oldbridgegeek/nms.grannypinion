<?php

namespace App\Http\Controllers;
use App\User;
use Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			return redirect($user_id);
		}
		return view('landing');
	}
}
