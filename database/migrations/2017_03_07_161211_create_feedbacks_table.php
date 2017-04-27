<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('feedbacks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->text('text');
			$table->integer('status')->default(0);
			$table->timestamps();
		});

		Schema::create('feedbacks_comments', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('feedback_id')->unsigned();
			$table->integer('parent_id')->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('anonymous')->default(0);
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
		Schema::dropIfExists('feedbacks');
		Schema::dropIfExists('feedbacks_comments');
	}
}
