<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\RepairImage;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RepairImagesSeeder extends BrandsSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'image' => 'storage/images/repair/grm1_full.jpg',
                'preview' => 'storage/images/repair/grm1_preview.jpg',
                'repair_id' => 120,
            ],
            [
                'image' => 'storage/images/repair/grm2_full.jpg',
                'preview' => 'storage/images/repair/grm2_preview.jpg',
                'repair_id' => 120,
            ],
            [
                'image' => 'storage/images/repair/grm3_full.jpg',
                'preview' => 'storage/images/repair/grm3_preview.jpg',
                'repair_id' => 120,
            ],
            [
                'image' => 'storage/images/repair/grm5_full.jpg',
                'preview' => 'storage/images/repair/grm5_preview.jpg',
                'repair_id' => 120,
            ],
            [
                'image' => 'storage/images/repair/clutch1_full.jpg',
                'preview' => 'storage/images/repair/clutch1_preview.jpg',
                'repair_id' => 121,
            ],
            [
                'image' => 'storage/images/repair/clutch3_full.jpg',
                'preview' => 'storage/images/repair/clutch3_preview.jpg',
                'repair_id' => 121,
            ],
            [
                'image' => 'storage/images/repair/clutch4_full.jpg',
                'preview' => 'storage/images/repair/clutch4_preview.jpg',
                'repair_id' => 121,
            ],
            [
                'image' => 'storage/images/repair/clutch2_full.jpg',
                'preview' => 'storage/images/repair/clutch2_preview.jpg',
                'repair_id' => 1053,
            ],
            [
                'image' => 'storage/images/repair/clutch3_full.jpg',
                'preview' => 'storage/images/repair/clutch3_preview.jpg',
                'repair_id' => 1053,
            ],
            [
                'image' => 'storage/images/repair/clutch4_full.jpg',
                'preview' => 'storage/images/repair/clutch4_preview.jpg',
                'repair_id' => 1053,
            ],
            [
                'image' => 'storage/images/repair/skoda_octavia_chain_grm1_full.jpg',
                'preview' => 'storage/images/repair/skoda_octavia_chain_grm1_preview.jpg',
                'repair_id' => 1750,
            ],
            [
                'image' => 'storage/images/repair/skoda_octavia_chain_grm2_full.jpg',
                'preview' => 'storage/images/repair/skoda_octavia_chain_grm2_preview.jpg',
                'repair_id' => 1750,
            ],
            [
                'image' => 'storage/images/repair/skoda_superb_replace_grm_chain2_full.jpg',
                'preview' => 'storage/images/repair/skoda_superb_replace_grm_chain2_preview.jpg',
                'repair_id' => 1750,
            ],
            [
                'image' => 'storage/images/repair/skoda_fabia_replace_brake_pads1_full.jpg',
                'preview' => 'storage/images/repair/skoda_fabia_replace_brake_pads1_preview.jpg',
                'repair_id' => 1031,
            ],
            [
                'image' => 'storage/images/repair/skoda_fabia_replace_brake_pads2_full.jpg',
                'preview' => 'storage/images/repair/skoda_fabia_replace_brake_pads2_preview.jpg',
                'repair_id' => 1031,
            ],
            [
                'image' => 'storage/images/repair/vw_passat_replace_brake_pads1_full.jpg',
                'preview' => 'storage/images/repair/vw_passat_replace_brake_pads1_preview.jpg',
                'repair_id' => 1031,
            ],
            [
                'image' => 'storage/images/repair/vw_passat_replace_auto_transmission_oil1_full.jpg',
                'preview' => 'storage/images/repair/vw_passat_replace_auto_transmission_oil1_preview.jpg',
                'repair_id' => 1778,
            ],
            [
                'image' => 'storage/images/repair/vw_passat_replace_auto_transmission_oil2_full.jpg',
                'preview' => 'storage/images/repair/vw_passat_replace_auto_transmission_oil2_preview.jpg',
                'repair_id' => 1778,
            ]
        ];

        foreach ($data as $item) {
            RepairImage::create($item);
        }
    }
}
