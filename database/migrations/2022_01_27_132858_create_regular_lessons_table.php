<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegularLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('professor_id');
            $table->time('time_start')->index()->default('00:00:00');
            $table->integer('day_week');
            $table->integer('length');
            $table->integer('status')->default(0)->comment('0->active|1->closed');
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
        Schema::dropIfExists('regulars');
    }
}
