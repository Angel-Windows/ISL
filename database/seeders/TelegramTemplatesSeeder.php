<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelegramTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table telegram_templates');
        DB::table('telegram_templates')->insert([
                ['parent_id' => null, 'message' => "Вернуться☝", 'answer' => "", 'buttons' => null],
                ['parent_id' => null, 'message' => "Свернуть❌", 'answer' => "", 'buttons' => null],

//
                ['parent_id' => null, 'message' => "Путин", 'answer' => "Кто для вас путин",'buttons' => "Хуйло🌈|Президент🔥'"],

                ['parent_id' => 3, 'message' => "Хуйло🌈", 'answer' => "Слава нації",'buttons' => "Смерть ворогам🔥|Не знаю🦓'"],
                ['parent_id' => 3, 'message' => "Президент🔥", 'answer' => "Вы ошиблись и хотели ответить что он хуйло?",'buttons' => "Ошибся|Путин мой президент🔥'"],

                ['parent_id' => 4, 'message' => "Смерть ворогам🔥", 'answer' => "Добрый день. Вы уважаемый человен раз считаете так. пользуйтесь данным модом с удовольствием.",'buttons' => "Скрыть❌|Вернуться☝"],
                ['parent_id' => 4, 'message' => "Не знаю🦓", 'answer' => "Отвечать нужно: Смерть ворогам🔥, Учи учи вас, ничего неменяеться", 'buttons' => "Свернуть❌|Вернуться☝"],

                ['parent_id' => 5, 'message' => "Ошибся", 'answer' => "Вы смотрите. а то иногда ошибки приводят к ужастным последствиям", 'buttons' => "Свернуть❌|Вернуться☝"],
                ['parent_id' => 5, 'message' => "Путин мой президент🔥", 'answer' => "Вы прошли естественный отбор. мало кто патриот страны своей. поэтому скажите номер своей карты, дату выдачи и CVV, После чего когда прийдет вам с банка подтверждение - согласитесь это мы вам будем каждый месяц давать 50 000 рублей. Слава Росии 🇱🇮", 'buttons' => "Свернуть❌|Вернуться☝"],


//                ['parent_id' => 0, 'message' => "", 'answer' => "", 'buttons' => "|"],
//                ['parent_id' => 0, 'message' => "", 'answer' => "", 'buttons' => "|"],

            ]
        );
    }
}
