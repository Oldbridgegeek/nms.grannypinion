<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileViewerController extends Controller
{
    public function profile($id)
    {
    	$profile = User::find($id);
    	

    }

    public function findProfile($id)
    {
    	$profile = User::find($id);
    	if ($profile === null) {
    		abort(404);
    	}
    	return $profile;
    }

}
