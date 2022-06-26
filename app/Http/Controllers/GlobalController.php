<?php

namespace App\Http\Controllers;

use App\Repositories\GlobalRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    private $globalRepository;
    private $transactionRepository;

    public function __construct()
    {
        $this->globalRepository = app(GlobalRepository::class);
        $this->transactionRepository = app(TransactionRepository::class);
    }

    public function ajax_filters(Request $request)
    {
        $filters = $this->globalRepository->change_filters($request);
        $new_data = [];
        if ($request['filter_name'] == 'filters_transaction') {
            $get_filter = $this->globalRepository->get_filter('filters_transaction');
            $new_data = $this->transactionRepository->get_list($get_filter);
        }

        return json_encode([
                'code' => $filters,
                'new_data' => $new_data
            ]
        );
    }
}
