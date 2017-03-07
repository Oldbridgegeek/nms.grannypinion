<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
	use Authenticatable, CanResetPassword;

	protected $fillable = [
		'firstname', 'lastname', 'email', 'password', 'city', 'verified', 'profilePicture',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function reviews() {
		return $this->hasMany(Review::class);
	}

	public function conversations() {
		return $this->hasMany(Conversation::class);
	}
}
