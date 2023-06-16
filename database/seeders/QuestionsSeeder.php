<?php

namespace Database\Seeders;

use App\Models\Question;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'question' => 'По закону дилерский сервис не имеет права отказывать вам в гарантийном обслуживании',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in orci eu erat sagittis mollis. Sed mattis arcu eget fermentum hendrerit. Curabitur mattis, quam et sollicitudin vulputate, odio lectus commodo dolor, a cursus purus nunc id nulla. Vivamus non nisi at ex aliquet porta vitae et ipsum. Mauris ac ex interdum, bibendum tortor non, commodo libero. Phasellus dictum congue odio, ac ullamcorper ipsum congue eget. Etiam interdum, turpis pharetra bibendum porttitor, dui magna dapibus augue, a convallis justo massa quis nisi. Morbi viverra finibus justo, a venenatis quam rhoncus posuere. Nullam in efficitur nisl, ac imperdiet elit. Nullam tellus tortor, bibendum id augue quis, sollicitudin tempus augue. In in dui a leo rutrum rutrum et ac elit. Pellentesque vulputate placerat purus at sodales. Cras porttitor enim nunc, sit amet consectetur lectus tempus ac.',
                'active' => 1
            ],
            [
                'question' => 'Наш сертифицированный автосалон не нарушает гарантию производителя',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in orci eu erat sagittis mollis. Sed mattis arcu eget fermentum hendrerit. Curabitur mattis, quam et sollicitudin vulputate, odio lectus commodo dolor, a cursus purus nunc id nulla. Vivamus non nisi at ex aliquet porta vitae et ipsum. Mauris ac ex interdum, bibendum tortor non, commodo libero. Phasellus dictum congue odio, ac ullamcorper ipsum congue eget. Etiam interdum, turpis pharetra bibendum porttitor, dui magna dapibus augue, a convallis justo massa quis nisi. Morbi viverra finibus justo, a venenatis quam rhoncus posuere. Nullam in efficitur nisl, ac imperdiet elit. Nullam tellus tortor, bibendum id augue quis, sollicitudin tempus augue. In in dui a leo rutrum rutrum et ac elit. Pellentesque vulputate placerat purus at sodales. Cras porttitor enim nunc, sit amet consectetur lectus tempus ac.',
                'active' => 1
            ],
            [
                'question' => 'В нашем центре вы всегда сможете выбрать удобное вам время для ремонта',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in orci eu erat sagittis mollis. Sed mattis arcu eget fermentum hendrerit. Curabitur mattis, quam et sollicitudin vulputate, odio lectus commodo dolor, a cursus purus nunc id nulla. Vivamus non nisi at ex aliquet porta vitae et ipsum. Mauris ac ex interdum, bibendum tortor non, commodo libero. Phasellus dictum congue odio, ac ullamcorper ipsum congue eget. Etiam interdum, turpis pharetra bibendum porttitor, dui magna dapibus augue, a convallis justo massa quis nisi. Morbi viverra finibus justo, a venenatis quam rhoncus posuere. Nullam in efficitur nisl, ac imperdiet elit. Nullam tellus tortor, bibendum id augue quis, sollicitudin tempus augue. In in dui a leo rutrum rutrum et ac elit. Pellentesque vulputate placerat purus at sodales. Cras porttitor enim nunc, sit amet consectetur lectus tempus ac.',
                'active' => 1
            ],
            [
                'question' => 'По желанию, мы можем организовывать рабочий процесс под контролем собственника',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in orci eu erat sagittis mollis. Sed mattis arcu eget fermentum hendrerit. Curabitur mattis, quam et sollicitudin vulputate, odio lectus commodo dolor, a cursus purus nunc id nulla. Vivamus non nisi at ex aliquet porta vitae et ipsum. Mauris ac ex interdum, bibendum tortor non, commodo libero. Phasellus dictum congue odio, ac ullamcorper ipsum congue eget. Etiam interdum, turpis pharetra bibendum porttitor, dui magna dapibus augue, a convallis justo massa quis nisi. Morbi viverra finibus justo, a venenatis quam rhoncus posuere. Nullam in efficitur nisl, ac imperdiet elit. Nullam tellus tortor, bibendum id augue quis, sollicitudin tempus augue. In in dui a leo rutrum rutrum et ac elit. Pellentesque vulputate placerat purus at sodales. Cras porttitor enim nunc, sit amet consectetur lectus tempus ac.',
                'active' => 1
            ],
            [
                'question' => 'Мы исправляем чужие ошибки',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in orci eu erat sagittis mollis. Sed mattis arcu eget fermentum hendrerit. Curabitur mattis, quam et sollicitudin vulputate, odio lectus commodo dolor, a cursus purus nunc id nulla. Vivamus non nisi at ex aliquet porta vitae et ipsum. Mauris ac ex interdum, bibendum tortor non, commodo libero. Phasellus dictum congue odio, ac ullamcorper ipsum congue eget. Etiam interdum, turpis pharetra bibendum porttitor, dui magna dapibus augue, a convallis justo massa quis nisi. Morbi viverra finibus justo, a venenatis quam rhoncus posuere. Nullam in efficitur nisl, ac imperdiet elit. Nullam tellus tortor, bibendum id augue quis, sollicitudin tempus augue. In in dui a leo rutrum rutrum et ac elit. Pellentesque vulputate placerat purus at sodales. Cras porttitor enim nunc, sit amet consectetur lectus tempus ac.',
                'active' => 1
            ],
        ];

        foreach ($data as $item) {
            Question::create($item);
        }
    }
}
