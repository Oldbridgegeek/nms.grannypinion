<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('reviews', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('stars_average')->nullable();
			$table->integer('stars_kindness')->nullable();
			$table->integer('stars_attractiveness')->nullable();
			$table->integer('stars_reliability')->nullable();
			$table->integer('stars_honesty')->nullable();
			$table->integer('stars_intelligence')->nullable();
			$table->integer('stars_fun')->nullable();
			$table->integer('subject_id')->nullable();
			$table->text('feedback')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('reviews');
	}
}
