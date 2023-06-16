<?php

namespace Database\Seeders;

use App\Models\Action;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'image' => 'storage/images/actions/action1.jpg',
            'text' => '<b>Замена масла бесплатно –</b><br>при первом посещении',
            'active' => 1
        ];

        for ($i=0;$i<5;$i++) {
            Action::create($data);
        }
    }
}
