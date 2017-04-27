<?php

namespace App\Http\Controllers;
use App\Survey;
// use App\Reply;
use DB;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SurveysController extends Controller {
	use ValidatesRequests;

	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$surveys = $this->getUserSurveys();
		return view('survey.index',compact('surveys'));
	}

	private function getUserSurveys()
	{
		return Auth::user()->surveys()->latest()->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function create() {
		return view('survey.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {
		$this->validate($request,[
			'title'=>'required',
			'description'=>'required'
		]);
		$survey = $this->createSurvey($request);

		$this->createSpecificQuestions($request, $survey);
		
		$surveys = $this->getUserSurveys();
		
		return redirect()->route('survey.index', compact('surveys'));
	}

	private function createSurvey($request)
	{
		return Survey::createSurvey($request->only(['title','description']));
	}

	private function createSpecificQuestions($request, $survey)
	{
		if(count($request->get('surveys')) && !empty($request->get('surveys')))
		{
			foreach ($request->get('surveys') as $surveyQuestion) {
				$survey->questions()->create([
					'title'=>$surveyQuestion['value'],
					'type'	=>	$surveyQuestion['type']
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
		$survey = $this->getUserSurvey($id);

		$answers = $survey->answers();

		return view('survey.details',compact('survey','answers'));
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
		$survey = $this->getUserSurvey($id);

		$survey->delete();

		$surveys = $this->getUserSurveys();

		return redirect()->route('survey.index', compact('surveys'));
	}

	private function getUserSurvey($id)
	{
		$survey = Auth::user()->surveys()->where('id',$id)->first();
		if ($survey === null) {
			abort(404);
		}
		return $survey;
	}

	public function list()
	{
		$data = [
			['type'=>0,'title'=>trans('app.survey_default')],
			['type'=>1,'title'=>trans('app.survey_star_rating')],
			['type'=>2,'title'=>trans('app.survey_text_input')],
			['type'=>3,'title'=>trans('app.survey_textarea')],
		];

		return $data;
	}
}