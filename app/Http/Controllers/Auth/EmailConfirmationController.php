<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class EmailConfirmationController extends Controller
{
    public function confirm($token)
    {
    	$user = User::where('token',$token)->first();
    	if($user === null)
    	{
    		abort(404);
    	}
    	$user->emailConfirm();
    	Auth::login($user);

    	return redirect('/home')->withMessage([
    		'status'=>'Your email has been confirmed!'
    	]);
    }
}
