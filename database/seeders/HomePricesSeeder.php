<?php

namespace Database\Seeders;

use App\Models\HomePrice;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Замена ремня ГРМ Форд от',
                'value' => 4200,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена сцепления Форд от',
                'value' => 5400,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена колодок Форд от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена масла в АКПП Форд от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена генератора Форд от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена свечей Форд от',
                'value' => 720,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Ремонт двигателя Форд от',
                'value' => 12000,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена сальника Форд от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена термостата Форд от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена радиатора Форд от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена цепи Форд от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена амортизатора Форд от',
                'value' => 1200,
                'active' => 1,
                'brand_id' => 1,
            ],
            [
                'name' => 'Замена колодок Фольксваген от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена радиатора Фольксваген от',
                'value' => 4200,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена ремня ГРМ Фольксваген от',
                'value' => 5400,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена масла в АКПП Фольксваген от',
                'value' => 1560,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена лампочек Фольксваген от',
                'value' => 180,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена подшипника Фольксваген от',
                'value' => 1920,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена свечей Фольксваген от',
                'value' => 720,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена помпы Фольксваген от',
                'value' => 1200,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена цепи Фольксваген от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Ремонт двигателя Фольксваген от',
                'value' => 12000,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена термостата Фольксваген от',
                'value' => 2160,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена сцепления Фольксваген от',
                'value' => 7800,
                'active' => 1,
                'brand_id' => 6,
            ],
            [
                'name' => 'Замена масла в Ауди от',
                'value' => 600,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена цепей Ауди от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена печки Ауди от',
                'value' => 16800,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена радиатора Ауди от',
                'value' => 5400,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена масла АКПП Ауди от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена термостата Ауди от',
                'value' => 3360,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена салонного фильтра Ауди от',
                'value' => 360,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена подшипника Ауди от',
                'value' => 1680,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена ремня ГРМ Ауди от',
                'value' => 7800,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена рычага Ауди от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Ремонт двигателя Ауди от',
                'value' => 14400,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена сальника Ауди от',
                'value' => 2520,
                'active' => 1,
                'brand_id' => 7,
            ],
            [
                'name' => 'Замена масла Шкода от',
                'value' => 600,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена ремня ГРМ Шкода от',
                'value' => 6600,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена колодок Шкода от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена радиатор Шкода от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена масла в АКПП Шкода от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена цепи Шкода от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена термостата Шкода от',
                'value' => 960,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Ремонт двигателя Шкода от',
                'value' => 10800,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена сайлентблоков Шкода от',
                'value' => 1200,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена амортизатора Шкода от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена тормозных дисков Шкода',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена генератора Шкода от',
                'value' => 2640,
                'active' => 1,
                'brand_id' => 11,
            ],
            [
                'name' => 'Замена масла Мазда от',
                'value' => 600,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена колодок Мазда от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена салонного фильтра Мазда от',
                'value' => 360,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена цепи Мазда от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена рычагов Мазда от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена подшипника Мазда от',
                'value' => 2160,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена сайлентблоков Мазда от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена радиатора Мазда от',
                'value' => 6600,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена термостата Мазда от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Генератор Мазда замена от',
                'value' => 2400,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена масла в АКПП Мазда от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Ремонт двигателя Мазда от',
                'value' => 19200,
                'active' => 1,
                'brand_id' => 23,
            ],
            [
                'name' => 'Замена масла Хёндэ от',
                'value' => 600,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена масла в АКПП Хёндэ от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена колодок Хендаи от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена ремней Хёндэ от',
                'value' => 960,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена радиатора Хёндэ от',
                'value' => 4200,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена цепи Хёндэ от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена подшипника Хёндэ от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена стекла Хёндэ от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Ремонт двигателя Хёндэ от',
                'value' => 19200,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена антифриза Хёндэ от',
                'value' => 1200,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена сайлентблоков Хёндэ от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена сцепления Хёндэ от',
                'value' => 5400,
                'active' => 1,
                'brand_id' => 28,
            ],
            [
                'name' => 'Замена масла Ниссан от',
                'value' => 600,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена салонного фильтра Ниссан от',
                'value' => 360,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена колодок Ниссан от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена свечей Ниссан от',
                'value' => 720,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена подшипника Ниссан от',
                'value' => 1920,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена цепи Ниссан от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена масла в вариаторе Ниссан от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена генератора Ниссан от',
                'value' => 2400,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена радиатора Ниссан от',
                'value' => 3600,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена рычагов Ниссан от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена сайлентблоков Ниссан от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена ступицы Ниссан от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 21,
            ],
            [
                'name' => 'Замена масла в АКПП Киа от',
                'value' => 1800,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена колодок Киа от',
                'value' => 840,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена цепи Киа от',
                'value' => 11400,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена радиатора Киа от',
                'value' => 3600,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена сайлентблоков Киа от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена фильтров Киа от',
                'value' => 240,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена генератора Киа от',
                'value' => 3000,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена ремня ГРМ Киа от',
                'value' => 960,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена сцепления Киа от',
                'value' => 5400,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена амортизаторов Киа от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена тормозных дисков Киа от',
                'value' => 1440,
                'active' => 1,
                'brand_id' => 31,
            ],
            [
                'name' => 'Замена ШРУС Киа от',
                'value' => 2640,
                'active' => 1,
                'brand_id' => 31,
            ]
        ];

        foreach ($data as $item) {
            HomePrice::create($item);
        }
    }
}
