<table class="app-data-table simple table-striped">
    <tr>
        <th>{{ trans('content.name') }}</th>
        <th>{{ trans('content.price') }} ₽</th>
    </tr>
    @foreach($price as $item)
        <tr>
            <td>
{{--                <a href="/{{ Request::path() }}/{{ $item->slug }}">{{ $rowHead }}</a>--}}
                <a href="{{ route('repair',[$car->brand->slug, $car->slug, $item->slug]) }}">{{ in_array($car->id, ['55', '56', '25']) ? $item->head : $item->head  .' '.$car->brand['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$car->brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}</a>
            </td>
            <td class="price">{{ $item->price_from ? trans('content.from').' '.$item->price : $item->price }}₽</td>
        </tr>
    @endforeach
</table>
