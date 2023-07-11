@foreach($spares as $spare)
    [<br>
    'slug' => '{{ $spare->slug }}',<br>
    'code' => {{ $spare->code ? '\''.$spare->code.'\'' : 'null' }},<br>
    'price_original' => {{ $spare->price_original ? $spare->price_original : 0 }},<br>
    'price_original_from' => {{ $spare->price_original_from }},<br>
    'price_non_original' => {{ $spare->price_non_original ? $spare->price_non_original : 0 }},<br>
    'price_non_original_from' => {{ $spare->price_non_original_from }},<br>
    'head' => '{{ $spare->head }}',<br>
    'text' => {{ $spare->text ? '\''.$spare->text.'\'' : 'null' }},<br>
    'active' => 1,<br>
    'car_id' => {{ $spare->car_id }},<br>

    @if ($spare->title_spares)
        'title_spares' => '{{ $spare->title_spares }}',<br>
    @endif
    @if ($spare->keywords_spares)
        'keywords_spares' => '{{ $spare->keywords_spares }}',<br>
    @endif
    @if ($spare->description_spares)
        'description_spares' => '{{ $spare->description_spares }}',<br>
    @endif
    ],<br>

{{--    [<br>--}}
{{--    'work_id' => {{ $work->work_id }},<br>--}}
{{--    'repair_id' => {{ $work->work_id }},<br>--}}
{{--    ],<br>--}}

@endforeach
