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
        $this->call([
            UsersSeeder::class,
            UsersProfilesSeeder::class,
]);
        $this->call([
            NavigationSeeder::class,
            RegularLessonsSeeder::class,
            CalendarSeeder::class,

//            RegularLessonsSeeder::class,
//            LessonsSeeder::class,
//            NavigationSeeder::class,
//            LinkingStudentsSeeder::class,
//            ServiceSeeder::class,
//            ThemesSeeder::class,
//            UserThemesSeeder::class,
//            UserRoleSeeder::class,
//            CountrySeeder::class,
//            UsersCountrySeeder::class,
//            PhoneSeeder::class,
//            TagsSeeder::class,
//            UsersTagsSeeder::class,
//            ChatSeeder::class,
//            ChatMessageSeeder::class,
//            CurrencySeeder::class,
//            UsersCurrencySeeder::class,
//            LayoutsSeeder::class,
//            UsersLayoutSeeder::class,
        ]);
    }
}
