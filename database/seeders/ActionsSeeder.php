<?php

namespace Database\Seeders;

use App\Models\Action;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Бесплатная замена масла при первом посещении',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Бесплатная диагностика подвески при первом посещении',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Бесплатная компьюторная диагностика',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Беспатная замена щеток стеклоочистителя',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Бесплатная электронная проверка натяжения цепи для TFSi 1,8-2,0л.',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Полная заправка кондиционера от 1200р.',
                'limit' => 1690848000,
                'active' => 1
            ],
            [
                'image' => 'storage/images/actions/action1.jpg',
                'image_small' => 'storage/images/actions/action1_small.jpg',
                'text' => 'Шиномонтаж по акции! Экономия до 30%',
                'limit' => 1690848000,
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            Action::create($item);
        }
    }
}
