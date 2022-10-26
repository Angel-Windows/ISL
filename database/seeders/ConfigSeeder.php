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
        $filters_calendar = [
            [
                'id' => 1,
                'name' => 'Проведен',
                'class' => 'background_calendar_success',
            ], [
                'id' => 2,
                'name' => "Запланирован",
                'class' => 'background_calendar_normal',
            ], [
                'id' => 3,
                'name' => "Перенесен",
                'class' => 'background_calendar_transfer',
            ], [
                'id' => 4,
                'name' => "Отменен",
                'class' => 'background_calendar_closed',
            ], [
                'id' => 5,
                'name' => "Удален",
                'class' => 'background_calendar_no_check',
            ]
        ];
        $filters_transactions = [
            [
                'id' => 0,
                'name' => "Урок",
                'class' => 'background_calendar_success',
            ], [
                'id' => 1,
                'name' => "Отмена",
                'class' => 'background_calendar_normal',
            ], [
                'id' => 2,
                'name' => "Пополнение",
                'class' => 'background_calendar_transfer',
            ]
        ];

        foreach ($filters_calendar as $key=>$item) {
            DB::table('configs')->insert([
                    ['name'=> $item['name'], 'group_name' => 'filters_calendar', 'value' => json_encode($item, JSON_UNESCAPED_UNICODE)],
                ]
            );
        }
        foreach ($filters_transactions as $key=>$item) {
            DB::table('configs')->insert([
                    ['name'=> $item['name'], 'group_name' => 'filters_transaction', 'value' => json_encode($item, JSON_UNESCAPED_UNICODE)],
                ]
            );
        }
    }
}
