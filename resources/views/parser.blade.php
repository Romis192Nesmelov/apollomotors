@foreach($cars as $car)
    [<br>
    'slug' => '{{ $car->slug }}',<br>
    'name_en' => '{{ $car->eng }}',<br>
    'name_ru' => '{{ $car->rus }}',<br>
    'image_full' => 'storage{{ $car->full }}',<br>
    'image_preview' => 'storage{{ $car->preview }}',<br>
    'image_width' => {{ $car->img_width }},<br>

    @if ($car->repair)
        'repair' => '{{ str_replace("\n",'',$car->repair) }}',<br>
    @endif
    @if ($car->maintenance)
        'maintenance' => '{{ str_replace("\n",'',$car->maintenance) }}',<br>
    @endif
    @if ($car->spares)
        'spares' => '{{ str_replace("\n",'',$car->spares) }}',<br>
    @endif

    @if ($car->title_repair)
        'title_repair' => '{{ $car->title_repair }}',<br>
    @endif
    @if ($car->title_maintenance)
        'title_maintenance' => '{{ $car->title_maintenance }}',<br>
    @endif
    @if ($car->title_spares)
        'title_spares' => '{{ $car->title_spares }}',<br>
    @endif

    @if ($car->keywords_repair)
        'keywords_repair' => '{{ $car->keywords_repair }}',<br>
    @endif
    @if ($car->keywords_maintenance)
        'keywords_maintenance' => '{{ $car->keywords_maintenance }}',<br>
    @endif
    @if ($car->keywords_spares)
        'keywords_spares' => '{{ $car->keywords_spares }}',<br>
    @endif

    @if ($car->description_repair)
        'description_repair' => '{{ $car->description_repair }}',<br>
    @endif
    @if ($car->description_maintenance)
        'description_maintenance' => '{{ $car->description_maintenance }}',<br>
    @endif
    @if ($car->description_spares)
        'description_spares' => '{{ $car->description_spares }}',<br>
    @endif

    'brand_id' => {{ $car->brand_id }},<br>
    'active' => {{ $car->active }}<br>
    ],<br>

@endforeach
