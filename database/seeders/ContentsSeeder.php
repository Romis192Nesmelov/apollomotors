<?php

namespace Database\Seeders;

use App\Models\Content;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContentsSeeder extends BrandsSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'head' => 'Сертифицированный автосервис Аполло-Моторс',
                'text' => '<p>Наша команда профессионалов готова предоставить вам высококачественные услуги по ремонту и техническому обслуживанию вашего автомобиля. Мы гарантируем сохранение заводской гарантии на все работы, выполненные нашими специалистами.</p><p>В отличие от других автосервисов, мы работаем честно и доступно. Мы не навязываем ненужные услуги и не берем лишних денег за ремонт. Мы предоставляем гарантию на все наши работы до 24 месяцев, что гарантирует качество наших услуг на длительный срок.</p><p>Обращаясь к нам, вы можете быть уверены в том, что ваш автомобиль будет работать как новый. Наши специалисты имеют большой опыт работы с автомобилями различных марок и моделей, поэтому они могут быстро и качественно выполнить любой ремонт.</p><p>Кроме того, мы предлагаем широкий спектр услуг, включая диагностику и технической обслуживание, замену масла и фильтров, ремонт подвески, тормозов и многое другое. Мы готовы помочь вам в любых вопросах, связанных с вашим автомобилем.</p><p>Если вы хотите сохранить заводскую гарантию на свой автомобиль и получить высококачественный ремонт, обращайтесь в автосервис Аполло Моторс! Мы всегда готовы помочь вам!</p>'
            ],
            [
                'head' => 'Сертифицированный автосервис Аполло-Моторс',
                'text' => '<p>Автосервис Аполло-Моторс - это место, где вы можете быть уверены в качестве работ и сохранности заводской гарантии на ваш автомобиль. Работаем с такими марками автомобилей как Ауди, Фольксваген, Шкода, Форд, Хендай, Кия, а также многими другими.</p><p>Наша команда состоит из опытных специалистов, которые имеют большой опыт работы с автомобилями разных марок. Они знают все тонкости и нюансы ремонта и обслуживания автомобилей, что позволяет нам предоставлять качественные услуги нашим клиентам.</p><p>Техцентр имеет свой склад запчастей, что позволяет быстро и эффективно выполнять работы по ремонту и обслуживанию автомобилей. Это делает нашу работу более доступной и удобной для наших клиентов. Мы используем только проверенные запчасти, современное оборудование и опытных специалистов, чтобы гарантировать высокое качество работы.</p><p>Одно из главных преимуществ работы с нами - это сохранение заводской гарантии на автомобиль. Мы гарантируем, что все работы будут выполнены в соответствии с требованиями производителя, что позволит вам сохранить гарантию на ваш автомобиль. Кроме того, мы предоставляем собственную гарантию на все работы до 24 месяцев, что означает, что если у вас возникнут какие-либо проблемы с вашим автомобилем, мы бесплатно заменим детали и устраним любые неисправности.</p><p>Автосервис Аполло-Моторс предлагает широкий спектр услуг по ремонту автомобилей, включая замену масла, ремонт двигателей, шиномонтаж, диагностику и многое другое. Мы всегда готовы помочь вам решить любые проблемы с вашим автомобилем. Так же, мы предлагаем честные и доступные цены на наши услуги. Мы стремимся предоставлять качественный сервис по разумной цене, чтобы наши клиенты могли получить максимальную выгоду от своих инвестиций в автомобиль.</p><p>Автосервис Аполло-Моторс – это место, где ваш автомобиль будет в надежных руках. Не откладывайте свой ремонт на потом, обращайтесь к нам уже сегодня и получайте качественный сервис от профессионалов по выгодной цене!</p>',
                'title' => 'Сертифицированный автосервис Аполло-Моторс',
                'keywords' => 'Автосервис Аполло-Моторс - это место, где вы можете быть уверены в качестве работ и сохранности заводской гарантии на ваш автомобиль. Работаем с такими марками автомобилей как Ауди, Фольксваген, Шкода, Форд, Хендай, Кия, а также многими другими.',
                'description' => 'Техцентр имеет свой склад запчастей, что позволяет быстро и эффективно выполнять работы по ремонту и обслуживанию автомобилей. Одно из главных преимуществ работы с нами - это сохранение заводской гарантии на автомобиль. Мы гарантируем, что все работы будут выполнены в соответствии с требованиями производителя, что позволит вам сохранить гарантию на ваш автомобиль.'
            ],
            [
                'slug' => 'repair',
                'head' => 'Ремонт',
                'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae ultricies libero, eu consectetur sem. Nunc at mi venenatis, viverra risus ac, ultrices ante. Aenean metus ligula, suscipit nec ornare sodales, egestas in lorem. Vivamus scelerisque ut lorem vel posuere. Proin facilisis hendrerit efficitur. In hac habitasse platea dictumst. Aliquam ipsum dui, molestie vel arcu vitae, consectetur sollicitudin turpis. Fusce id maximus dolor. Mauris dapibus, mi tempor pretium luctus, nunc est tristique purus, ut porttitor felis ligula sit amet enim. Morbi neque justo, scelerisque vitae massa sit amet, auctor vulputate neque. Praesent dapibus sem et orci accumsan mollis. Aenean eros est, tincidunt quis ligula euismod, accumsan tristique velit. Pellentesque sollicitudin vitae justo sit amet mollis. Aliquam et finibus enim.</p><p>Nam non lacinia nibh, non pretium nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed ac dolor non est pharetra elementum. Fusce convallis eget arcu et interdum. Aenean tincidunt lorem sit amet nisi laoreet efficitur. Donec massa justo, vestibulum non leo ut, euismod varius odio. Phasellus ut lorem a ipsum semper consectetur ut ut dolor. Quisque blandit cursus nunc, a tincidunt lacus viverra sit amet. Sed venenatis purus odio, convallis rutrum diam porta et. Nullam ut imperdiet tellus, vel ullamcorper felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur nec euismod nunc, non bibendum elit. Praesent aliquet justo est, vel placerat arcu aliquet id.</p>',
                'title' => 'Техцентр Apollo Motors &mdash; одно из редких исключений на отечественном рынке профильных услуг.'
            ],
            [
                'slug' => 'maintenances',
                'head' => 'Техобслуживание',
                'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae ultricies libero, eu consectetur sem. Nunc at mi venenatis, viverra risus ac, ultrices ante. Aenean metus ligula, suscipit nec ornare sodales, egestas in lorem. Vivamus scelerisque ut lorem vel posuere. Proin facilisis hendrerit efficitur. In hac habitasse platea dictumst. Aliquam ipsum dui, molestie vel arcu vitae, consectetur sollicitudin turpis. Fusce id maximus dolor. Mauris dapibus, mi tempor pretium luctus, nunc est tristique purus, ut porttitor felis ligula sit amet enim. Morbi neque justo, scelerisque vitae massa sit amet, auctor vulputate neque. Praesent dapibus sem et orci accumsan mollis. Aenean eros est, tincidunt quis ligula euismod, accumsan tristique velit. Pellentesque sollicitudin vitae justo sit amet mollis. Aliquam et finibus enim.</p><p>Nam non lacinia nibh, non pretium nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed ac dolor non est pharetra elementum. Fusce convallis eget arcu et interdum. Aenean tincidunt lorem sit amet nisi laoreet efficitur. Donec massa justo, vestibulum non leo ut, euismod varius odio. Phasellus ut lorem a ipsum semper consectetur ut ut dolor. Quisque blandit cursus nunc, a tincidunt lacus viverra sit amet. Sed venenatis purus odio, convallis rutrum diam porta et. Nullam ut imperdiet tellus, vel ullamcorper felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur nec euismod nunc, non bibendum elit. Praesent aliquet justo est, vel placerat arcu aliquet id.</p>',
                'title' => 'Сертифицированный технический центр Apollo Motors (Аполло Моторс)&nbsp;- это автосервис,&nbsp;который&nbsp;не боится пускать клиентов в ремзону и давать 2 года гарантии на работы.'
            ],
            [
                'slug' => 'spare',
                'head' => 'Запчасти',
                'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae ultricies libero, eu consectetur sem. Nunc at mi venenatis, viverra risus ac, ultrices ante. Aenean metus ligula, suscipit nec ornare sodales, egestas in lorem. Vivamus scelerisque ut lorem vel posuere. Proin facilisis hendrerit efficitur. In hac habitasse platea dictumst. Aliquam ipsum dui, molestie vel arcu vitae, consectetur sollicitudin turpis. Fusce id maximus dolor. Mauris dapibus, mi tempor pretium luctus, nunc est tristique purus, ut porttitor felis ligula sit amet enim. Morbi neque justo, scelerisque vitae massa sit amet, auctor vulputate neque. Praesent dapibus sem et orci accumsan mollis. Aenean eros est, tincidunt quis ligula euismod, accumsan tristique velit. Pellentesque sollicitudin vitae justo sit amet mollis. Aliquam et finibus enim.</p><p>Nam non lacinia nibh, non pretium nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed ac dolor non est pharetra elementum. Fusce convallis eget arcu et interdum. Aenean tincidunt lorem sit amet nisi laoreet efficitur. Donec massa justo, vestibulum non leo ut, euismod varius odio. Phasellus ut lorem a ipsum semper consectetur ut ut dolor. Quisque blandit cursus nunc, a tincidunt lacus viverra sit amet. Sed venenatis purus odio, convallis rutrum diam porta et. Nullam ut imperdiet tellus, vel ullamcorper felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur nec euismod nunc, non bibendum elit. Praesent aliquet justo est, vel placerat arcu aliquet id.</p>',
                'title' => 'Мы не только предлагаем оригинальные детали и качественные реплики, но и низкие тарифы на услуги автосервиса.'
            ],
        ];

        foreach ($data as $k => $item) {
            list($item, $seo) = $this->getSeo($item);
            $item['text'] = str_replace('Аполло-Моторс', '<a href="'.url('/').'" title="Техцентр">Аполло-Моторс</a>',$item['text']);
            $content = Content::create($item);
            $this->setSeo($content->id, 'content_id', '', $seo);
        }
    }
}
