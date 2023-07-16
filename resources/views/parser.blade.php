@foreach($items as $item)
    [<br>
    'repair_id' => {{ $item->repair_id }},<br>
    'work_id' => {{ $item->work_id }},<br>
    ],<br>
{{--    [<br>--}}
{{--    'id' => {{ $item->id }},<br>--}}
{{--    'slug' => '{{ $item->slug }}',<br>--}}
{{--    'price' => {{ $item->price }},<br>--}}
{{--    'old_price' => {{ $item->old_price ? $item->old_price : 'null' }},<br>--}}
{{--    'price_from' => {{ $item->price_from }},<br>--}}
{{--    'work_time' => {{ $item->work_time }},<br>--}}
{{--    'upon_reaching_years' => {{ $item->upon_reaching_years }},<br>--}}
{{--    'upon_reaching_mileage' => {{ $item->upon_reaching_mileage }},<br>--}}
{{--    'upon_reaching_conditions' => {{ $item->upon_reaching_conditions }},<br>--}}
{{--    'free_diagnostics' => {{ $item->free_diagnostics }},<br>--}}
{{--    'warranty_years' => {{ $item->warranty_years }},<br>--}}
{{--    'head' => '{{ $item->head }}',<br>--}}
{{--    'text' => {{ $item->text ? '\''.$item->text.'\'' : 'null' }},<br>--}}
{{--    'active' => 1,<br>--}}
{{--    'car_id' => {{ $item->car_id }},<br>--}}
{{--    'title_repair' => '{{ $item->title_repair }}',<br>--}}
{{--    'description_repair' => '{{ $item->description_repair }}'<br>--}}
{{--    ],<br>--}}
@endforeach
