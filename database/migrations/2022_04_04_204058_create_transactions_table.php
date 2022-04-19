<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->index();
            $table->integer('professor_id')->index();
            $table->integer('lesson_id');
            $table->integer('new_balance');
            $table->integer('amount');
            $table->integer('status')->comment('0->Waiting, 1->success, 2->cancel');
            $table->integer('type')->comment('0->lesson_success, 1->lesson_cancel, 3->payed, 4->present');
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
        Schema::dropIfExists('transactions');
    }
}
