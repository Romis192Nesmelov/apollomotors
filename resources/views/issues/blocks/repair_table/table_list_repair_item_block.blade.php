<tr>
    <td>
        <a href="{{ route('repair',[$car->brand->slug, $car->slug, $item->slug]) }}">
            @include('issues.blocks.repair_table.table_list_repair_name_block')
        </a>
    </td>
    <td class="price">@include('issues.blocks.repair_table.table_list_repair_price_block')</td>
</tr>
