<?php

namespace App\Repositories;


use App\Models\Transactions;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends BaseRepository
{
//    private $globalRepository;

    public function __construct()
    {
//        $this->globalRepository = app(GlobalRepository::class);
    }

    public function get_table($data_sql)
    {
        $transaction = DB::table('transactions')
            ->join('users_profiles', 'users_profiles.user_id', 'transactions.student_id')
            ->where($data_sql)
            ->select(
                'transactions.*',
                'users_profiles.name as student_name',
//                'users_profiles.last_name as student_last_name'
            )
            ->orderByDesc("transactions.id")->get();
        return $transaction;
    }

    public function get_list($filter)
    {
        $status_list = [];
        foreach ($filter as $item) {
            if ($item->display) {
                $status_list[] = $item->id;
            }
        }
        if (!count($status_list)) {
            $status_list = [0, 1, 2, 3, 4, 5, 6, 7, 8];
        }
        return Transactions::where('status', '>', -1)
            ->leftJoin('users_profiles AS student', 'student.user_id', 'transactions.student_id')
            ->leftJoin('users_profiles AS professor', 'professor.user_id', 'transactions.professor_id')
            ->whereIn('transactions.type', $status_list)
            ->select('transactions.*',
                "student.name as student_name",
                "professor.name as professor_name",
                "student.balance as balance",
            )
//            ->select('transactions.*',
//                "student.first_name as student_first_name", "student.last_name as student_last_name",
//                "professor.first_name as professor_first_name", "professor.last_name as professor_last_name",
//            )
            ->orderBy('transactions.id', 'desc')
            ->paginate(20);
    }
}
