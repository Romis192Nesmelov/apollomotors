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
                'image' => 'storage/images/clients/logo_dl.svg',
                'name' => 'Деловые линии',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_marr.svg',
                'name' => 'MARR Russia',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_ali_express.svg',
                'name' => 'Ali Express',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_ars.svg',
                'name' => 'Авторемонтные системы',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_rubezh.svg',
                'name' => 'Rubezh global',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_k&k.svg',
                'name' => 'Фирма К&К',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_eurologistic.svg',
                'name' => 'Еврологистика',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_ochakovo.svg',
                'name' => 'Очаково. Натуральные напитки',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_leader.svg',
                'name' => 'Лидер',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_av.svg',
                'name' => 'Азбука вкуса',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_mks.svg',
                'name' => 'Департамент физической культуры и спорта г.Москвы',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_bauer.svg',
                'name' => 'BAUER',
                'active'  => 1
            ],
            [
                'image' => 'storage/images/clients/logo_beer_trade.svg',
                'name' => 'Beer Trade',
                'active'  => 1
            ],
        ];

        foreach ($data as $item) {
            Client::create($item);
        }

    }
}
