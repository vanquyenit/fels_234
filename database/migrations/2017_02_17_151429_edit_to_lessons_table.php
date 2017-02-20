<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditToLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->renameColumn('category_id', 'course_id');
            $table->renameColumn('result', 'level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->renameColumn('course_id', 'category_id');
            $table->renameColumn('level', 'result');
        });
    }
}
