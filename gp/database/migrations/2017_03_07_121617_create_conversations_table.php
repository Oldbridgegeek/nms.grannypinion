<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration {
	public function up() {
		Schema::create('conversations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('user_id_1');
			$table->string('user_id_2');
		});
	}

	public function down() {
		Schema::dropIfExists('conversations');
	}
}
