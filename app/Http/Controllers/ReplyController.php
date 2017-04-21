<?php

namespace App\Http\Controllers;

use App\SurveyQuestionValue;
use App\Survey;
use Auth;
use User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ReplyAdded;


class ReplyController extends Controller {

	public function __construct()
	{
		// $this->middleware('interactingWithYourselfNotAllowed');
	}
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
	public function create($survey_id) {
		$survey = $this->getSurvey($survey_id);

		if ($survey === null) {
			abort(404);
		}

		return view('survey.reply',compact('survey'));
		
	}

	private function getSurvey($survey_id)
	{
		return Survey::where('id',$survey_id)->with('questions')->first();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->except(['_token']);
		$survey = $this->getSurvey($data['survey_id']);

		$this->persistQuestionValues($data);

		if ($survey->user->canReceiveEmails()) {
			\Mail::to($survey->user)->send(new ReplyAdded($survey));
		}
	
		return view('guest.thankyou');
	}

	private function persistQuestionValues($data)
	{
		if(is_array($data) && !empty($data))
		{
			$survey_id = array_get($data, 'survey_id');

			array_forget($data,'survey_id');
			$reply_identifier = str_random(10);
			foreach($data as $key => $value)
			{
				SurveyQuestionValue::create([
					'survey_question_id' => $key,
					'title'	=> $value,
					'survey_id'=> $survey_id,
					'reply_identifier' => $reply_identifier
				]);
			}
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