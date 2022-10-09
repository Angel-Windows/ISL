<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table users');
        DB::table('users')->insert([
                ["hash" => $this->create_hash(),'telegram_id'=> 324428256, 'email' => 'eliphas.sn@gmail.com', 'password' => Hash::make(2706)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'heramn@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'sayler.sn@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'markaganbegyan@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'sergey@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> 1931209341, 'email' => 'artem@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'egor@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'dsharapovad@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'maxdimuraelios@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'max_elin@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> null, 'email' => 'angelina@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(),'telegram_id'=> 952336186, 'email' => 'syperdan100@gmail.com', 'password' => Hash::make(1232)],
            ]
        );
    }

    private function create_hash()
    {
        do {
            $hash = "";
            $symbol = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
            for ($i = 0; $i < 7; $i++) {
                $hash .= $symbol[rand(0, count($symbol) - 1)];
            }
        } while (User::where('hash', $hash)->first());
        return $hash;
    }
}
