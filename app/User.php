<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use Hash;
use Image;
use Mail;
use App\Mail\EmailConfirmation;
use App\Feedback;


class User extends Authenticatable {
	use Notifiable;

	const EMAIL_CONFIRMED = 1;
	const EMAIL_NOT_CONFIRMED = 0;
	const TOKEN_EXPIRED = null;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'firstname', 
		'lastname', 
		'city', 
		'email', 
		'password', 
		'avatar', 
		'public', 
		'token',
		'email_notifications',

	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public static function registerAndLogin($user)
	{
		$user = self::create([
			'firstname'	=>	$user['firstname'],
			'lastname'	=>	$user['lastname'],
			'email'		=>	$user['email'],
			'password'	=>	bcrypt($user['password']),
			'token'		=>	str_random(30)
		]);
		Auth::login($user);
		
		return $user;
	}

	public function emailConfirm()
    {
    	$this->token = self::TOKEN_EXPIRED;
    	$this->verified = self::EMAIL_CONFIRMED;
    	return $this->save();
    }

    public function isEmailConfirmed()
    {
    	return (bool) $this->verified;
    }

    public function updateProfile($data)
    {
    	$this->assignNewInfo($data);
    	$this->uploadAvatar($data);
    	$this->save();
    }

    //send email ONLY when email changed
    private function sendEmailConfirmationMessage($email)
    {
    	if ($email != $this->email) {
    		$this->verified = self::EMAIL_NOT_CONFIRMED;
	    	$this->token = str_random(25);
    		$this->email = $email;
	    	\Mail::to($this)->send(new EmailConfirmation($this));
    	}
    }

    private function assignNewInfo($data)
    {
    	$password = array_get($data,'password');
    	if ($password !== null) {
    		$this->password = bcrypt($password);
    	}
    	$this->firstname = $data['firstname'];

    	$this->lastname = $data['lastname'];

    	$this->email_notifications = array_has($data, 'email_notifications');

    	$this->sendEmailConfirmationMessage($data['email']);

    }

    private function uploadAvatar($data)
    {
    	if(array_has($data,'avatar'))
    	{
    		if(file_exists('uploads/avatars/' . $this->avatar) && is_file('uploads/avatars/' . $this->avatar))
    		{
    			unlink('uploads/avatars/' . $this->avatar);
    		}
    		$avatar = $data['avatar'];
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
			$this->avatar = $filename;	
    	}
		
    }

    public function getFullName()
    {
    	return $this->firstname . PHP_EOL . $this->lastname;
    }

    public function getFolder()
    {
    	return '/uploads/avatars/';
    }

    public function getImage()
    {
    	if ($this->avatar === null) {
    		return $this->getFolder() . 'default/default.jpg';
    	}
    	return $this->getFolder() . $this->avatar;
    }

	/**
	 * Get the users feedbacks.
	 *
	 * @return [type] [description]
	 */
	public function feedbacks() {
		return $this->hasMany(Feedback::class, 'user_id');
	}

	/**
	 * Get all user conversations.
	 *
	 * @return [type] [description]
	 */
	public function receivedConversations() {
		return $this->hasMany(Conversation::class, 'receiver_id');
	}

	/**
	 * Get all user conversations.
	 *
	 * @return [type] [description]
	 */
	public function startedConversations() {
		return $this->hasMany(Conversation::class, 'sender_id');
	}

	public function polls() {
		return $this->hasMany(Poll::class,'user_id');
	}

	public function isAuthor()
	{
		if (Auth::check()) {
			return $this->id == Auth::user()->id;
		}
		return false;
	}

	public function authorizedUser()
	{
		return Auth::check();
	}

	public static function getUser($user_id)
	{
		return User::where('id',$user_id)
					->with(['feedbacks' => function($query){
						$query->orderBy('created_at','desc');
						$query->with(['comments' => function($query){
							$query->where('parent_id',null);
							$query->with('children');
						}]);
				}])->first();
	}

	public function getFeedbacksCount()
	{
		return $this->feedbacks()->where('status',1)->count();
	}

	public function canReceiveEmails()
	{
		return $this->email_notifications === 0 ? false : true;
	}
}
