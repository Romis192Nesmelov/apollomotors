<?php

namespace Database\Seeders;

use App\Models\Check;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChecksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Check::factory()->count(50)->create();

        $data = [
            [
                'name' => 'Проверка ламп освещения автомобиля',
                'active' => 1,
                'free_check_id' => 1,
            ],
            [
                'name' => 'Проверка сигнальных ламп автомобиля',
                'active' => 1,
                'free_check_id' => 1,
            ],
            [
                'name' => 'Проверка состояние щеток стеклоочестителя',
                'active' => 1,
                'free_check_id' => 1,
            ],
            [
                'name' => 'Проверка работы стеклоомывателя',
                'active' => 1,
                'free_check_id' => 1,
            ],
            [
                'name' => 'Проверка звукового сигнала',
                'active' => 1,
                'free_check_id' => 1,
            ],
            [
                'name' => 'Проверка работы сцепления',
                'active' => 1,
                'free_check_id' => 1,
            ],

            [
                'name' => 'Провркка состояния приводных ременй',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка состояния шлангов и патрубков',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка течи масла двигателя',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка течи антифриза',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка течи топлива',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка видимых участков электропроводки',
                'active' => 1,
                'free_check_id' => 2,
            ],
            [
                'name' => 'Проверка уровеня моторного масла',
                'active' => 1,
                'free_check_id' => 3,
            ],
            [
                'name' => 'Проверка уровеня масла АКПП (при наличии щупа)',
                'active' => 1,
                'free_check_id' => 3,
            ],
            [
                'name' => 'Проверка уровеня охлаждающей жидкости (антифриза)',
                'active' => 1,
                'free_check_id' => 3,
            ],
            [
                'name' => 'Проверка уровеня и качества тормозной жидкости',
                'active' => 1,
                'free_check_id' => 3,
            ],
            [
                'name' => 'Проверка уровеня жидкости ГУР (при наличии)',
                'active' => 1,
                'free_check_id' => 3,
            ],
            [
                'name' => 'Проверка наличия стеклоомывающией жидкости',
                'active' => 1,
                'free_check_id' => 3,
            ],

            [
                'name' => 'Проверка выхлопной системы',
                'active' => 1,
                'free_check_id' => 4,
            ],
            [
                'name' => 'Проверка состояния кузова',
                'active' => 1,
                'free_check_id' => 4,
            ],
            [
                'name' => 'Проверка на наличие течей жидкостей',
                'active' => 1,
                'free_check_id' => 4,
            ],
            [
                'name' => 'Проверка состояния картеров',
                'active' => 1,
                'free_check_id' => 4,
            ],
            [
                'name' => 'Проверка состояния трубок и шлангов',
                'active' => 1,
                'free_check_id' => 4,
            ],
            [
                'name' => 'Проверка состояния карданного вала (при наличии)',
                'active' => 1,
                'free_check_id' => 4,
            ],

            [
                'name' => 'Проверка состояния торомзных колодок',
                'active' => 1,
                'free_check_id' => 5,
            ],
            [
                'name' => 'Проверка состояния тормозных дисков',
                'active' => 1,
                'free_check_id' => 5,
            ],
            [
                'name' => 'Проверка состояния тормозных шлангов',
                'active' => 1,
                'free_check_id' => 5,
            ],
            [
                'name' => 'Проверка течи и уровня тормозной жидкости',
                'active' => 1,
                'free_check_id' => 5,
            ],
            [
                'name' => 'Проверка роботы ручного тормоза',
                'active' => 1,
                'free_check_id' => 5,
            ],

            [
                'name' => 'Проверка на люфт стоек и втулок стабилизатора',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка целостности пружин подвески',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка на  наличие течи амортизаторов',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка сайленьблоков рычагов',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка состояния ступичных подшипников',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка рулевых механизмов',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка состояния и износ шин',
                'active' => 1,
                'free_check_id' => 6,
            ],
            [
                'name' => 'Проверка состояния пыльников ШРУС',
                'active' => 1,
                'free_check_id' => 6,
            ],
        ];

        foreach ($data as $item) {
            Check::create($item);
        }
    }
}
