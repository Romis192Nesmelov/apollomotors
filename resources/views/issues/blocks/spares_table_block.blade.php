<div class="big-table-container">
    <table class="app-data-table simple table-striped">
        <tr>
            <th>{{ trans('content.name') }}</th>
            <th>{{ trans('content.part_code') }}</th>
            <th>{{ trans('content.price') }}<br>{{ trans('content.by_original') }} ₽</th>
            <th>{{ trans('content.price') }}<br>{{ trans('content.by_non_original') }} ₽</th>
        </tr>
        @foreach($prices as $price)
            <tr>
                <td>
                    @if ($price->text)
                        <a href="/{{ Request::path() }}/{{ $price->slug }}">{{ $price->head.' '.ucfirst($car->brand->name_ru).' '.$car->name_ru.' ('.ucfirst($car->brand->name_en).' '.$car->name_en.')' }}</a>
                    @else
                        {{ $price->head.' '.ucfirst($car->brand->name_ru).' '.$car->name_ru.' ('.ucfirst($car->brand->name_en).' '.$car->name_en.')' }}
                    @endif
                </td>
                <td class="code">{{ $price->code }}</td>
                <td class="price">{{ $price->price_original_from ? trans('content.from').' '.$price->price_original : $price->price_original }}₽</td>
                <td class="price">{{ $price->price_non_original_from ? trans('content.from').' '.$price->price_non_original : $price->price_non_original }}₽</td>
            </tr>
        @endforeach
    </table>
</div>
