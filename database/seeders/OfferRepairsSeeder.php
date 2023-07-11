<?php

namespace Database\Seeders;

use App\Models\OfferRepair;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferRepairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Ремонт приборной панели','Ремонт трансмиссии','Ремонт стартера','Ремонт сцепления'];
        $count = 1;
        for ($i=0;$i<16;$i++) {
            if ($count > 4) $count = 1;
            OfferRepair::create([
                'name' => $data[$count-1],
                'image' => 'storage/images/offer_repairs/repair'.$count.'.jpg',
                'active' => 1
            ]);
            $count++;
        }
    }
}
