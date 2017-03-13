<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {
	/**
	 * Search for users.
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function search(Request $request) {
		$users = $this->filterThroughUserNames($request);

		if ($users->count() == 0) {
			return "Kein Treffer für Vorname: $request->firstname und Nachname: $request->lastname.";
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
			return $this->inFirstName($user->firstname, $request->firstname)
			|| $this->inLastName($user->lastname, $request->lastname);
		});
	}
}
