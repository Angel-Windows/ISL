<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->index();
            $table->integer('professor_id')->index();
            $table->integer('regular_id')->nullable()->index();
            $table->integer('year')->index();
            $table->integer("week");
            $table->integer("day_week");
            $table->date('fool_time')->index();
            $table->time('time_start')->index();
            $table->integer('length')->default(60);
            $table->integer('status')->default(1)
                ->comment('0->Success, 1->constant, 2->postponed, 3->canceled, 4->unmarked');
            $table->integer('theme_id')->nullable();
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
        Schema::dropIfExists('calendars');
    }
}
