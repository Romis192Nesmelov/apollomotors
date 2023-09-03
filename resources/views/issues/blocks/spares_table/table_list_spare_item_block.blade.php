<tr>
    <td>
        @if ($item->text)
            <a href="{{ route('spare',[$car->brand->slug, $car->slug, $item->slug]) }}">
                @include('issues.blocks.table_list_name_block')
            </a>
        @else
            @include('issues.blocks.table_list_name_block')
        @endif
    </td>
    <td class="code">{{ $item->code }}</td>
    <td class="price">@include('issues.blocks.table_list_price_block', ['price_from' => $item->price_original_from, 'price' => $item->price_original])</td>
    <td class="price">@include('issues.blocks.table_list_price_block', ['price_from' => $item->price_non_original_from, 'price' => $item->price_non_original])</td>
</tr>
