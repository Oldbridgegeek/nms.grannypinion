<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('link');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('surveys_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned();
            $table->string('title');
            $table->integer('type');
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('surveys_questions_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_question_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('reply_identifier');
            $table->integer('survey_id');
            $table->foreign('survey_question_id')->references('id')->on('surveys_questions')->onDelete('cascade');
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
        Schema::dropIfExists('surveys_questions_values');
        Schema::dropIfExists('surveys_questions');
        Schema::dropIfExists('surveys');
    }
}
