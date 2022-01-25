<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->float('balance')->default(0);
            $table->float('temp_balance')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->text('avatar')->nullable();
            $table->integer('gender')->default(0);
            $table->integer('currency')->default('1')->nullable();
            $table->timestamps();
            $table->text('git_profile')->nullable()->unique();
            $table->integer('price_lesson')->default(250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profiles');
    }
}
