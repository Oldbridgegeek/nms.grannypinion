<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Search for users.
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function search(Request $request) {
		$users = $this->filterThroughUserNamesExtended($request);

		if ($users->count() == 0) {
			return view('user.search', ['request'=>$request->get('name')]);
		}

		return view('user.search', compact('users'));
	}

	/**
	 * Filter through user names.
	 *
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	private function filterThroughUserNames($request) {
		return User::all()->filter(function ($user) use ($request) {
			return $this->inName($user->firstname, $request->firstname)
			|| $this->inName($user->lastname, $request->lastname);
		});
	}

	private function filterThroughUserNamesExtended($request) {
		$counter = substr_count($request->name, " ");
		if ($counter == 0) {
			$request->firstname = $request->name;
			$request->lastname = "";
			$users1 = $this->filterThroughUserNames($request);
			$request->firstname = "";
			$request->lastname = $request->name;
			$users2 = $this->filterThroughUserNames($request);
			return $users1->merge($users2);
		} else if ($counter == 1) {
			list($name1, $name2) = explode(" ", $request->name);
			$request->firstname = $name1;
			$request->lastname = $name2;
			$users1 = $this->filterThroughUserNames($request);
			$request->firstname = $name2;
			$request->lastname = $name1;
			$users2 = $this->filterThroughUserNames($request);
			return $users1->merge($users2);
		} else {
			dd('To many names');
		}

	}

	private function inName($name, $nameMatch) {
		return str_contains(strtolower($name), strtolower($nameMatch));
	}

	private function countNames($name) {
		$count = substr_count($name, " ");
		return $count;
	}
}
