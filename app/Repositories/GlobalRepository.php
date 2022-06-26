<?php

namespace App\Repositories;

use App\Models\Config;

class GlobalRepository extends BaseRepository
{
    private $transactionRepository;
    public function __construct()
    {
        $this->transactionRepository = app(TransactionRepository::class);
    }
    public function change_filters($request){
        $filter_name = $request['filter_name'] ?? 'filters_calendar';
        $id = $request['id'];

        $filter = session($filter_name) ?? [1, 2, 3, 4, 5];

        $arr_s = array_search($id, $filter);
        if ($arr_s === false) {
            array_push($filter, $id);
        } else {
            unset($filter[$arr_s]);
        }
        if (count($filter) == 0) {
            $filter = [1, 2, 3, 4, 5,];
        }
//        $filter = [1, 2, 3, 4, 5,];
        session([$filter_name => $filter]);

    }
    public function get_filter($filter_name){
        $filters = Config::where('group_name', $filter_name)->get();
        $filter_data = [];
        foreach ($filters as $key => $item) {
            $json_filters = json_decode($item->value);

//            dd(session($filter_name));
            if (!session()->has($filter_name)) {
                $display = true;
            } else if (in_array($json_filters->id, session($filter_name))) {
                $display = true;
            } else {
                $display = false;
            }
            $filter_data[$key] = json_decode($item['value']);
            $filter_data[$key]->display = $display;
        }
        return $filter_data;
    }
}
