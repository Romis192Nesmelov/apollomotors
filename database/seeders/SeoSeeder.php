<?php

namespace Database\Seeders;

use App\Models\Content;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seo::create(
            [
                'title' => 'Аполло Моторс г.Москва ЗАО – сертифицированный автосервис, ремонт всех марок авто!',
                'keywords' => 'Ремонт машины автомобиля Москва ЗАО Очаково рябиновая улица шиномонтаж замена масла',
                'description' => 'Клубный сервис по ремонту, ТО и продаже запчастей для автомобилей. Обслуживание и ремонт коммерческого транспорта. Гарантия на работы 2 года!'
            ]
        );
    }
}
