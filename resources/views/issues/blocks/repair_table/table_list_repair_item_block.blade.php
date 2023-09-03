<tr>
    <td>
        <a href="{{ route('repair',[$car->brand->slug, $car->slug, $item->slug]) }}">
            @include('issues.blocks.table_list_name_block')
        </a>
    </td>
    <td class="price">@include('issues.blocks.table_list_price_block', ['price_from' => $item->price_from, 'price' => $item->price])</td>
</tr>
