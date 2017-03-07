<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function search(Request $request) {
		$users = User::all();
		$searchedUsers1 = array();
		$searchedUsers2 = array();

		if (!empty($request->firstname)) {
			foreach ($users as $user) {
				if (strpos(strtolower($user->firstname), strtolower($request->firstname)) !== false) {
					$searchedUsers1[] = $user;
				};
			}
		}
		if (!empty($request->lastname)) {
			foreach ($users as $user) {
				if (strpos(strtolower($user->lastname), strtolower($request->lastname)) !== false) {
					$searchedUsers2[] = $user;
				};
			}
		}

		if (!empty($request->firstname) && !empty($request->lastname)) {
			$result = array_intersect($searchedUsers1, $searchedUsers2);
		} elseif (!empty($request->lastname)) {
			$result = $searchedUsers2;
		} elseif (!empty($request->firstname)) {
			$result = $searchedUsers1;
		}

		$users = $result;
		if ($users !== []) {
			return view('search', compact('users'));
		} else {
			return view('noResult', compact('request'));
		}

	}

	public function feedback(User $user) {
		return view('feedback', compact('user'));
	}

	public function profile(User $user) {
		return view('profile', compact('user'));
	}

}