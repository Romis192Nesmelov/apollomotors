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
                'password' => '$2y$10$3dx6ThiJaU/OL2KIf0OZj.eWb45M1lvI0cwhIqBMFt91gZ/BEHNI2',
                'type' => 2
            ],
            [
                'email' => 'apollomo@yandex.ru',
                'password' => '$2y$10$Ssncwf1OAKu4xwP57XhgFuPo0nsaRMNV5FGTwkeAZ9n0RqX4zSD9a',
                'type' => 3
            ],
            [
                'email' => 'romis.nesmelov@gmail.com',
                'password' => bcrypt('fuckingpassword192'),
                'type' => 3
            ],
            [
                'email' => 'serv2@apollomotors.ru',
                'password' => '$2y$10$U/DhLo7fB1hJgY1RM03MJeT8bimv5u1i54KOAt49vgoGKqXX1MMeS',
                'type' => 3
            ],
            [
                'email' => 'romanov@apollomotors.ru',
                'password' => '$2y$10$g40UD6XiwJ1Wzcde7.eyXOda6w/5EW4wUI6nAqFxOcnatz6UvpKBW',
                'type' => 3
            ],
            [
                'email' => '1952808@list.ru',
                'password' => '$2y$10$dbA7E07qaCdcycLcCpUDpeu9NZc35jfTAgfwFcVPuQMBf6x/gJqv6',
                'type' => 3
            ],
            [
                'email' => 'test@apollomotors.ru',
                'password' => '$2y$10$SlPkUKv7ON/MwNo3Qs5HfO1e3pL.T1bBH2s8LQAsJqj3RqOtnWVYy',
                'type' => 3
            ],
            [
                'email' => 'alexhock@yandex.ru',
                'password' => '$2y$10$5tCbRKUTmTOBCgJcixUYEeCtlZFWXAsqUOm7Ni9SJW9UPuV34h4Rm',
                'type' => 3
            ],
            [
                'email' => 'serv@apollomotors.ru',
                'password' => '$2y$10$U14oXXhHxSWTZelfFy5KJ.6wM0P19N7KbVjPT8xqZ8Hb4u/cDvAOe',
                'type' => 3
            ],
            [
                'email' => 'seoupsu42@gmail.com',
                'password' => '$2y$10$S.Zrdpf3CvOq/tZcmW0/Z.iMJsTbYT0Z1eywhg87bXgZ4a1CaxAdG',
                'type' => 3
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
