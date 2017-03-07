<?php
namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller {
	public function store(Request $request) {
		$reviewClone = new Review;
		$reviewClone->starsAverage = $request->starsAverage;
		$reviewClone->starsHonesty = $request->starsHonesty;
		$reviewClone->starsReliability = $request->starsReliability;
		$reviewClone->starsFun = $request->starsFun;
		$reviewClone->starsAttractiveness = $request->starsAttractiveness;
		$reviewClone->starsIntelligence = $request->starsIntelligence;
		$reviewClone->starsKindness = $request->starsKindness;
		$reviewClone->feedbackString = $request->feedbackString;
		$reviewClone->user_id = $request->user_id;
		\DB::table('reviews')->insert(['starsAverage' => $reviewClone->starsAverage, 'starsKindness' => $reviewClone->starsKindness, 'user_id' => $reviewClone->user_id, 'starsIntelligence' => $reviewClone->starsIntelligence, 'starsAttractiveness' => $reviewClone->starsAttractiveness, 'starsReliability' => $reviewClone->starsReliability, 'starsHonesty' => $reviewClone->starsHonesty, 'starsFun' => $reviewClone->starsFun, 'feedbackString' => $reviewClone->feedbackString]);
		return redirect('/');
	}

}