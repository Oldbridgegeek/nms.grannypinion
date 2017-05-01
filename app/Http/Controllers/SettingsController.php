<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function settings(Request $request)
    {
    	$user = Auth::user();

    	return view('user.setting', compact('user'));
    }

    public function update(Request $request)
    {
    	$this->validator($request->all())->validate();

    	$this->updateProfile($request->except(['_token']));

    	$request->session()->flash('status', trans('app.profile_updated'));

    	return redirect()->back();
    }

    private function updateProfile(array $data)
    {
    	$user = Auth::user();
    	return $user->updateProfile($data);
    }

    protected function update_avatar(Request $request) {
		if ($request->hasFile('avatar')) {
			$user = Auth::user();
			$avatar = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
			$user->avatar = $filename;
			$user->save();
		}
		return view('user.setting');
	}

	protected function validator(array $data) {
		return Validator::make($data, [
			'firstname'		=> 'required|max:50',
			'lastname'		=> 'required|max:50',
			'email'			=> [
						        'email',
						        'max:50',
						        Rule::unique('users')->ignore(Auth::user()->id),
		    				],
			'password' 		=> 'nullable|min:6',
			'avatar'		=>	'image'	
		]);
	}
}
