@foreach($items as $item)
    [<br>
    'id' => {{ $item->id }},<br>
    'slug' => '{{ $item->slug }}',<br>
    'code' => {{ $item->code ? '\''.$item->code.'\'' : 'null' }},<br>
    'price_original' => {{ $item->original ? $item->original : '0' }},<br>
    'price_original_from' => {{ $item->price_original_from ? $item->price_original_from : '0' }},<br>
    'price_non_original' => {{ $item->price_non_original ? $item->price_non_original : '0' }},<br>
    'price_non_original_from' => {{ $item->price_non_original_from ? $item->price_non_original_from : '0' }},<br>
    'head' => '{{ $item->head }}',<br>
    'text' => {{ $item->text ? '\''.$item->text.'\'' : 'null' }},<br>
    'active' => 1,<br>
    'car_id' => {{ $item->car_id }},<br>
    @if ($item->title_spares)
        'title_spare' => '{{ $item->title_spares }}',<br>
    @endif
    @if ($item->keywords_spares)
        'keywords_spare' => '{{ $item->keywords_spares }}',<br>
    @endif
    @if ($item->description_spares)
        'description_spare' => '{{ $item->description_spares }}',<br>
    @endif
    ],<br>
{{--    [<br>--}}
{{--    'id' => {{ $item['repair']->id }},<br>--}}
{{--    'slug' => '{{ $item['repair']->slug }}',<br>--}}
{{--    'price' => {{ $item['repair']->price }},<br>--}}
{{--    'old_price' => {{ $item['repair']->old_price ? $item['repair']->old_price : 'null' }},<br>--}}
{{--    'price_from' => {{ $item['repair']->price_from }},<br>--}}
{{--    'work_time' => {{ $item['repair']->work_time }},<br>--}}
{{--    'upon_reaching_years' => {{ $item['repair']->upon_reaching_years }},<br>--}}
{{--    'upon_reaching_mileage' => {{ $item['repair']->upon_reaching_mileage }},<br>--}}
{{--    'upon_reaching_conditions' => {{ $item['repair']->upon_reaching_conditions }},<br>--}}
{{--    'free_diagnostics' => {{ $item['repair']->free_diagnostics }},<br>--}}
{{--    'warranty_years' => {{ $item['repair']->warranty_years }},<br>--}}
{{--    'head' => '{{ $item['repair']->head }}',<br>--}}
{{--    'text' => {{ $item['repair']->text ? '\''.$item['repair']->text.'\'' : 'null' }},<br>--}}
{{--    'active' => 1,<br>--}}
{{--    'car_id' => {{ $item['repair']->car_id }},<br>--}}
{{--    'spares_image' => {{ $item['image'] ? '\''.$item['image'].'\'' : 'null' }},<br>--}}
{{--    @if ($item['repair']->seo)--}}
{{--        'title_repair' => '{{ $item['repair']->seo->title }}',<br>--}}
{{--        'description_repair' => '{{ $item['repair']->seo->description }}'<br>--}}
{{--    @endif--}}
{{--    ],<br>--}}
@endforeach
