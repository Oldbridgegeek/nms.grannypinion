<?php

namespace App\Http\Controllers;

use App\SurveyQuestionValue;
use App\Survey;
use Auth;
use User;
use Illuminate\Http\Request;
use Mail;

class ReplyController extends Controller {
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
		$survey = Survey::find($survey_id)->with('questions')->first();
		return view('survey.reply',compact('survey'));
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->except(['_token']);
		
		$this->populateQuestionValues($data);
		
	
		return view('guest.thankyou');

	}

	private function populateQuestionValues($data)
	{
		if(is_array($data) && !empty($data))
		{
			foreach($data as $key => $value)
			{
				// $model = new SurveyQuestionValue;
				// $model->survey_question_id = $key;
				// $model->title = $value;
				// $model->save();
				// SurveyQuestionValue::create([
				// 	'survey_question_id' => $key,
				// 	'title'	=> $value
				// ]);
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