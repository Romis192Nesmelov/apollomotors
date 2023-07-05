<?php

namespace Database\Seeders;

use App\Models\Brand;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Ford',
                'image' => 'ford.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'Cadillac',
                'image' => 'cadillac.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Chevrolet',
                'image' => 'chevrolet.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Chrysler',
                'image' => 'chrysler.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Jeep',
                'image' => 'jeep.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Volkswagen',
                'image' => 'volkswagen.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'Audi',
                'image' => 'audi.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'Mercedes',
                'image' => 'mercedes.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'BMW',
                'image' => 'bmw.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Opel',
                'image' => 'opel.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'ŠKODA',
                'image' => 'skoda.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'Peugeot',
                'image' => 'peugeot.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Renault',
                'image' => 'renault.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Citroen',
                'image' => 'citroen.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Fiat',
                'image' => 'fiat.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Seat',
                'image' => 'seat.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Volvo',
                'image' => 'volvo.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'MINI',
                'image' => 'mini.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Honda',
                'image' => 'honda.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Suzuki',
                'image' => 'suzuki.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Nissan',
                'image' => 'nissan.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Infiniti',
                'image' => 'infiniti.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Mazda',
                'image' => 'mazda.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'Toyota',
                'image' => 'toyota.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Lexus',
                'image' => 'lexus.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Mitsubishi',
                'image' => 'mitsubishi.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Isuzu',
                'image' => 'isuzu.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Hyundai',
                'image' => 'hyundai.png',
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'SsangYong',
                'image' => 'ssang_yong.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Genesis',
                'image' => 'genesis.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'KIA',
                'image' => 'kia.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Geely',
                'image' => 'geely.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Zeekr',
                'image' => 'zeekr.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Haval',
                'image' => 'haval.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Chery',
                'image' => 'chery.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Omoda',
                'image' => 'omoda.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Exeed',
                'image' => 'exeed.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Lifan',
                'image' => 'lifan.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Dongfeng',
                'image' => 'dongfeng.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Evolute',
                'image' => 'evolute.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'FAW',
                'image' => 'faw.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Jac',
                'image' => 'Jac.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Lixiang (Li Auto)',
                'image' => 'lixiang.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Voyah',
                'image' => 'voyah.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Tank',
                'image' => 'tank.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Lada',
                'image' => 'lada.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Sollers',
                'image' => 'sollers.png',
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'Москвич',
                'image' => 'moskvitch.png',
                'elected' => false,
                'active' => 1
            ]
        ];

        foreach ($data as $item) {
            $item['image'] = 'storage/images/brands/'.$item['image'];
            Brand::create($item);
        }
    }
}
