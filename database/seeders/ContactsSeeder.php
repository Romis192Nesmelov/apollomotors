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
                'active' => 1
            ],
            [
                'icon' => 'icon-home7',
                'contact' => 'Территория ПТО (Пункт технического осмотра), въезд со стороны ул. Рябиновая 45. Ближайшее метро Молодежная, Кунцевская, Юго-Западная. Район: Очаково - Матвеевское.',
                'active' => 1
            ],
            [
                'icon' => 'icon-envelop5',
                'contact' => 'info@apollomotors.ru',
                'active' => 1
            ],
            [
                'icon' => 'icon-envelop5',
                'contact' => 'info@apo2.ru',
                'active' => 1
            ],
            [
                'icon' => 'icon-alarm',
                'contact' => 'Ежедневно с 10.00 до 21.00',
                'active' => 1
            ],
            [
                'icon' => 'icon-phone-wave',
                'contact' => '+7 495 507-52-57',
                'active' => 1
            ],
            [
                'icon' => 'icon-iphone',
                'contact' => '+7 925 507-52-57',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-whatsapp',
                'contact' => 'https://wa.me/74955075257',
                'active' => 1
            ],
            [
                'icon' => 'icon-paperplane',
                'contact' => 'https://tele.click/74955075257',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-vk',
                'contact' => 'http://vk.com/apollomotors',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-facebook',
                'contact' => 'https://www.facebook.com/ApolloMotorsRUS/',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-twitter',
                'contact' => 'https://twitter.com/#!/ApolloMotors',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-youtube-play',
                'contact' => 'https://www.youtube.com/channel/UCZFcwa_yKa-_TCSHxo-BR0w',
                'active' => 1
            ],
            [
                'icon' => 'fa fa-instagram',
                'contact' => 'https://www.instagram.com/apollomotorsrus/',
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            Contact::create($item);
        }
    }
}
