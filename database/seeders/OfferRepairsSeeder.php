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
        $data = [
            'Замена масла',
            'Замена фильтров',
            'Замена ремня ГРМ',
            'Замена колодок',
            'Замена подшипников',
            'Техническое обслуживание',
            'Ремонт двигателя',
            'Замена радиаторов',
            'Замена цепи ГРМ',
            'Замена сайлентблоков',
            'Замена рычагов',
            'Ремонт турбины',
            'Замена сальников',
            'Компьюторная диагностика',
            'Замена сцепления',
            'Замена амортизаторов'
        ];
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
