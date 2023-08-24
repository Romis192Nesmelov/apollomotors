<?php
namespace Database\Seeders;

use App\Models\Mechanic;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MechanicsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 10, 'name' => 'Родионов Александр'],
            ['id' => 11, 'name' => 'Енгашев Федор'],
            ['id' => 12, 'name' => 'Енгашев Александр'],
            ['id' => 13, 'name' => 'Семенов Алексей'],
            ['id' => 14, 'name' => 'Макаренков Андрей']
        ];

        foreach ($data as $item) {
            $item['active'] = 1;
            Mechanic::create($item);
        }
    }
}
