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
        HomePrice::factory()->count(75)->create();
    }
}
