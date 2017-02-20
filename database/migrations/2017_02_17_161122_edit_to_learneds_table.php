<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditToLearnedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learneds', function (Blueprint $table) {
            $table->renameColumn('word_id', 'course_id');
            $table->integer('lesson_id')->unsigned();
            $table->integer('lesson_word_id')->unsigned();
            $table->integer('correct')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learneds', function (Blueprint $table) {
            $table->renameColumn('course_id', 'word_id');
            $table->dropColumn('lesson_id');
            $table->dropColumn('lesson_word_id');
            $table->dropColumn('correct');
        });
    }
}
