<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('rooms_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('pal_id');
            $table->integer('room_id');
            $table->integer('created_id')->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('rooms_users');
        Schema::dropIfExists('messages');
    }
}
