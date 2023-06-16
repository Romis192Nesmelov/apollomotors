<?php

namespace Database\Seeders;

use App\Models\Contact;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'icon' => 'icon-location4',
                'contact' => 'г. Москва, ул. Генерала Дорохова, 10Д',
                'type' => 1,
                'active' => 1
            ],
            [
                'icon' => 'icon-envelop5',
                'contact' => 'info@apollomotors.ru',
                'type' => 2,
                'active' => 1
            ],
            [
                'icon' => 'icon-alarm',
                'contact' => 'Ежедневно с 10.00 до 21.00',
                'type' => 3,
                'active' => 1
            ],
            [
                'icon' => 'icon-phone-wave',
                'contact' => '+7 495 507-52-57',
                'type' => 4,
                'active' => 1
            ],
            [
                'icon' => 'icon-phone-wave',
                'contact' => '+7 495 507-52-57',
                'type' => 4,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-whatsapp',
                'contact' => 'https://wa.me/74955075257',
                'type' => 5,
                'active' => 1
            ],
            [
                'icon' => 'icon-paperplane',
                'contact' => 'https://tele.click/74955075257',
                'type' => 6,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-skype',
                'contact' => 'skype:@apollomotors?call',
                'type' => 7,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-vk',
                'contact' => 'vk.me/apollomotors',
                'type' => 8,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-facebook',
                'contact' => 'https://www.facebook.com/ApolloMotorsRUS',
                'type' => 8,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-youtube-play',
                'contact' => 'https://www.youtube.com/channel/UCZFcwa_yKa-_TCSHxo-BR0w',
                'type' => 8,
                'active' => 1
            ],
            [
                'icon' => 'fa fa-odnoklassniki',
                'contact' => 'https://www.ok.ru/apolloMotors',
                'type' => 8,
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            Contact::create($item);
        }
    }
}
