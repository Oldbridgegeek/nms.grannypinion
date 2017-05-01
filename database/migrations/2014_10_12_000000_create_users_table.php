<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('city')->nullable();
			$table->string('email')->unique();
			$table->boolean('public')->default(0);
			$table->integer('verified')->default(0);
			$table->string('token')->nullable();
			$table->string('password');
			$table->string('avatar')->nullable();
			$table->boolean('email_notifications')->default(1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
