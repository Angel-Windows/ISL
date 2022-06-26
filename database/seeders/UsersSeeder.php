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
                ["hash" => $this->create_hash(), 'email' => 'eliphas.sn@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'syperdan100@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'sayler.sn@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'markaganbegyan@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'sergey@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'artem@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'egor@school.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'dsharapovad@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'maxdimuraelios@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'max_elin@gmail.com', 'password' => Hash::make(1232)],
                ["hash" => $this->create_hash(), 'email' => 'angelina_rozhkovan@gmail.com', 'password' => Hash::make(1232)],
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
