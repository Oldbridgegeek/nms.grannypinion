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
			$table->integer('user_id')->nullable();
			$table->text('text');
			$table->integer('status')->default(0);
			$table->timestamps();
		});

		Schema::create('reviews_comments', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('review_id')->unsigned();
			$table->integer('parent_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('text');
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
		Schema::dropIfExists('reviews_comments');
	}
}
