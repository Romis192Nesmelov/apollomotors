<?php

namespace Database\Seeders;

use App\Models\FreeCheck;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FreeChecksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Общие проверки',
                'active' => 1
            ],
            [
                'name' => 'Проверка под капотом',
                'active' => 1
            ],
            [
                'name' => 'Проверка жидкостей',
                'active' => 1
            ],
            [
                'name' => 'Проверка под автомобилем',
                'active' => 1
            ],
            [
                'name' => 'Проверка шин',
                'active' => 1
            ],
            [
                'name' => 'Проверка тормозных механизмов',
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            FreeCheck::create($item);
        }
    }
}
