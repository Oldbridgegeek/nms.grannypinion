<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTreeToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedbacks_comments', function(Blueprint $table){
            $table->integer('left_side');
            $table->integer('right_side');
            $table->integer('depth');
            $table->string('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedbacks_comments', function(Blueprint $table){
            $table->dropColumn('left_side');
            $table->dropColumn('right_side');
            $table->dropColumn('depth');
            $table->dropColumn('group');
        });
    }
}
