<?php

namespace Database\Seeders;

use App\Models\Client;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'image' => 'storage/images/clients/armtek.png',
                'name' => 'Группа компаний ARMTEK',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/velesstroy.png',
                'name' => 'Велесстрой',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/vistex.png',
                'name' => 'Vistex',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/vkuswill.png',
                'name' => 'ВкусВилл',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/armtek.png',
                'name' => 'Группа компаний ARMTEK',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/velesstroy.png',
                'name' => 'Велесстрой',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/vistex.png',
                'name' => 'Vistex',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/vkuswill.png',
                'name' => 'ВкусВилл',
                'active'  => 1
            ],
        ];

        foreach ($data as $item) {
            Client::create($item);
        }

    }
}
