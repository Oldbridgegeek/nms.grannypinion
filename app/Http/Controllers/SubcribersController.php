<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Mail;
use Illuminate\Http\Request;
use App\Subcriber;

class SubcribersController extends Controller {
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$subcriber = new Subcriber([
			'email' => $request->email,

		]);

		$subcriber->save();

		$email = $request->email;

		Mail::send('email.subscribe', ['email' =>  $email], function ($message) use ($email) {
			$message->from('postmaster@grannypinion.de', 'Grannypinion - Abonnent');
			$message->to( $email );
		});
		return redirect()->route('welcome');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */


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