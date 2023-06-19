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
        Check::factory()->count(50)->create();
    }
}
