<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table configs');
        $data_status = [
            [
                'id' => 1,
                'name' => "success",
                'class' => 'background_calendar_success',
            ], [
                'id' => 2,
                'name' => "constant",
                'class' => 'background_calendar_normal',
            ], [
                'id' => 3,
                'name' => "postponed",
                'class' => 'background_calendar_transfer',
            ], [
                'id' => 4,
                'name' => "canceled",
                'class' => 'background_calendar_closed',
            ], [
                'id' => 5,
                'name' => "unmarked",
                'class' => 'background_calendar_no_check',
            ]
        ];
        foreach ($data_status as $key=>$item) {
            DB::table('configs')->insert([
                    ['name'=> $item['name'], 'group_name' => 'filters', 'value' => json_encode($item)],
                ]
            );
        }
    }
}
