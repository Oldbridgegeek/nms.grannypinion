<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {
	public function up() {
		Schema::create('reviews', function (Blueprint $table) {
			$table->increments('id');
			$table->string('user_id')->unsigned()->index();
			$table->string('starsAverage');
			$table->string('starsKindness');
			$table->string('starsAttractiveness');
			$table->string('starsReliability');
			$table->string('starsHonesty');
			$table->string('starsIntelligence');
			$table->string('starsFun');
			$table->string('feedbackString');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('posts');
	}
}
