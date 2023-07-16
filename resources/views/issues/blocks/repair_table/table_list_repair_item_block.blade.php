<tr>
    <td>
        <a href="{{ route('repair',[$car->brand->slug, $car->slug, $item->slug]) }}">{{ in_array($car->id, ['55', '56', '25']) ? $item->head : $item->head  .' '.view('issues.blocks.car_name_block', ['car' => $car, 'simple' => false])->render() }}</a>
    </td>
    <td class="price">{{ $item->price_from ? trans('content.from').' '.$item->price : $item->price }}₽</td>
</tr>
