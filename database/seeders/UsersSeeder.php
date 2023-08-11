<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email' => 'romis@nesmelov.com',
                'password' => bcrypt('apg192'),
                'type' => 3
            ],
            [
                'email' => 'taran@apollomotors.ru',
                'password' => bcrypt('taran'),
                'type' => 2
            ],
            [
                'email' => 'guest@apollomotors.ru',
                'password' => bcrypt('guest'),
                'type' => 1
            ],
        ];

        foreach ($data as $item) {
            User::create($item);
        }
    }
}
