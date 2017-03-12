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
			$table->integer('stars_average');
			$table->integer('stars_kindness');
			$table->integer('stars_attractiveness');
			$table->integer('stars_reliability');
			$table->integer('stars_honesty');
			$table->integer('stars_intelligence');
			$table->integer('stars_fun');
			$table->integer('subject_id');
			$table->text('feedback');
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
