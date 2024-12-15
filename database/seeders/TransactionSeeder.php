<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table transactions');
//        DB::table('transactions')->insert([
//                ['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 123, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 12311, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 444, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 13, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 341, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],['student_id' => 2, 'professor_id' => 1, 'lesson_id' => 6, 'new_balance' => 3800, 'amount' => 200, 'status' => 1, 'type' => 2, "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 1 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 1, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 2, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//                ['student_id' => 5, 'professor_id' => 1, 'lesson_id' => 1, 'new_balance' => 122, 'amount' => 200, 'status' => 0, 'type' => 2 , "created_at"=> '2022-04-04 00:38:09'],
//            ]
//        );
    }
}
