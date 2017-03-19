<?php

namespace App\Http\Controllers;
use App\Http\Requests\ReviewStoreRequest;
use App\Review;
use Auth;
use App\User;
use Mail;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;

class ReviewsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ReviewStoreRequest $request) {
		$user = User::find($request->user_id);

		$review = new Review([
			'user_id' => $request->user_id,
			'stars_average' => $request->starsAverage,
			'stars_kindness' => $request->starsKindness,
			'stars_attractiveness' => $request->starsAttractiveness,
			'stars_reliability' => $request->starsReliability,
			'stars_honesty' => $request->starsHonesty,
			'stars_intelligence' => $request->starsIntelligence,
			'stars_fun' => $request->starsFun,
			'feedback' => $request->feedback,
		]);

		$review->addSubject(intval($request->subject_id));
		$review->save();

		Mail::send('email.feedback', ['user' =>  $user], function ($message) use ($user) {
			$message->from('witwitenes@gmail.com', 'Grannypinion - Bewertung');
			$message->to( $user->email );
		});


		if (Auth::check()) {
			return redirect('/'+$request->user_id);
		} else {
			return view('guest.thankyou');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
