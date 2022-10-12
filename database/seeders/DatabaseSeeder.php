<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (env('PERSONAL_SEEDER')) {
            $this->call([
                UsersSeeder::class,
                UsersProfilesSeeder::class,
                TransactionSeeder::class,
                RegularLessonsSeeder::class,
                CalendarSeeder::class,
                ReferalSeeder::class,
            ]);
        }
        $this->call([
            TelegramTemplatesSeeder::class,
            NavigationSeeder::class,
            ConfigSeeder::class,
        ]);
    }
}
