<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActionBrand;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class ActionsBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allBrands = Brand::pluck('id');
        $someBrands = Brand::whereIn('slug',['volkswagen','audi','skoda','seat'])->pluck('id');

        for ($i=1;$i<=7;$i++) {
            if ($i != 5) {
                foreach ($allBrands as $id) {
                    ActionBrand::create([
                        'brand_id' => $id,
                        'action_id' => $i
                    ]);
                }
            } else {
                foreach ($someBrands as $id) {
                    ActionBrand::create([
                        'brand_id' => $id,
                        'action_id' => $i
                    ]);
                }
            }
        }
    }
}
