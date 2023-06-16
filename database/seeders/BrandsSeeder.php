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
                'name' => 'ford',
                'image' => 'ford.png',
                'type' => 1,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'volkswagen',
                'image' => 'volkswagen.png',
                'type' => 0,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'mazda',
                'image' => 'mazda.png',
                'type' => 0,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'skoda',
                'image' => 'skoda.png',
                'type' => 0,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'audi',
                'image' => 'audi.png',
                'type' => 1,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'haval',
                'image' => 'haval.png',
                'type' => 1,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'hyundai',
                'image' => 'hyundai.png',
                'type' => 0,
                'elected' => true,
                'active' => 1
            ],
            [
                'name' => 'seat',
                'image' => 'seat.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'volvo',
                'image' => 'volvo.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'mercedes',
                'image' => 'mercedes.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'renault',
                'image' => 'renault.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'nissan',
                'image' => 'nissan.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'toyota',
                'image' => 'toyota.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'mini',
                'image' => 'mini.png',
                'type' => 1,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'geely',
                'image' => 'geely.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'honda',
                'image' => 'honda.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'opel',
                'image' => 'opel.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'chery',
                'image' => 'chery.png',
                'type' => 1,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'chevrolet',
                'image' => 'chevrolet.png',
                'type' => 1,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'lifan',
                'image' => 'lifan.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'peugeot',
                'image' => 'peugeot.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'citroen',
                'image' => 'citroen.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'suzuki',
                'image' => 'suzuki.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'lexus',
                'image' => 'lexus.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'fiat',
                'image' => 'fiat.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
            [
                'name' => 'kia',
                'image' => 'kia.png',
                'type' => 0,
                'elected' => false,
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            $item['image'] = 'storage/images/brands/'.$item['image'];
            Brand::create($item);
        }
    }
}
